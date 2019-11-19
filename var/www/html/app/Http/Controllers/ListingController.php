<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Validator;

class ListingController extends Controller
{
	/**
	 * List out all listing records
	 */
	public function index()
	{
		$data['listing'] = Listing::paginate(15);

		return view('admin.listing', $data);
	}

	/**
     * Listing form 
     *
     * @param string $id
     */
	public function form($id = null)
	{
		if ($id != null) {
			$data['url'] = 'admin/listing/update/' . $id;
			$data['listing'] = Listing::find($id);
		} else {
			$data['url'] = 'admin/listing/create';
			$data['listing'] = new Listing();
		}

		return view('admin.listing_form', $data);
	}

	/**
     * Create new listing
     *
     * @param Request $request
     */
	public function create(Request $request)
	{
    	// Validate input
		$validator = Validator::make(
			$request->all(),
			[
				'list_name' => 'required',
				'address' => 'required',
				'latitude' => 'required',
				'longitude' => 'required'
			]
		);

		if ($validator->fails()) {
			return redirect('admin/listing/create')
				->withErrors($validator)
				->withInput();
		}

		// Save
		$listing = new Listing;

		$listing->list_name = $request->list_name;
		$listing->address = $request->address;
		$listing->latitude = $request->latitude;
		$listing->longitude = $request->longitude;
		$listing->submitter_id = auth()->user()->id;

		$listing->save();

		return redirect('admin/listing')->with('success', 'New listing has been created.');
	}

	/**
     * Update listing information
     *
     * @param string  $id
     * @param Request $request
     */
	public function update($id, Request $request)
	{
    	
		// Validate input
		$validator = Validator::make(
			$request->all(),
			[
				'list_name' => 'required',
				'address' => 'required',
				'latitude' => 'required',
				'longitude' => 'required'
			]
		);

		if ($validator->fails()) {
			return redirect('admin/listing/update/' . $id)
				->withErrors($validator)
				->withInput();
		}

		try {

			// Update
			$listing = Listing::find($id);

			$listing->list_name = $request->list_name;
			$listing->address = $request->address;
			$listing->latitude = $request->latitude;
			$listing->longitude = $request->longitude;
			$listing->submitter_id = auth()->user()->id;

			$listing->save();

			return redirect('admin/listing')->with('success', '"' . $listing->list_name . '" record has been updated.');
		} catch (\Illuminate\Database\QueryException $e) {
			return redirect('admin/listing/update/' . $id)->with('error', 'Your form input is not correct.');
		}
	}

	/**
     * Delete listing
     *
     * @param string $id
     */
	public function delete($id)
	{
		$listing = Listing::find($id);
		$listing->delete();

		return redirect('admin/listing')->with('success', '"' . $listing->list_name . '" record has been deleted.');
	}

	/**
     * Get listing from token user ID and order by nearest distance by user latitude and longitude
     *
     * @param Request $request
     */
	public function apiGetListing(Request $request)
	{
		if ($request->has('user_id') && $request->has('latitude') && $request->has('longitude')) {
			
			$listing = Listing::select('listing.*')
				->selectRaw(
					'TRUNCATE(( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?)) + sin( radians(?) ) * sin( radians( latitude ) ) )), 3) AS distance',
					[$request->latitude, $request->longitude, $request->latitude]
				)
				->where('submitter_id', $request->user_id)
				->orderBy('distance', 'asc')
				->get();

			if ($listing->count()) {
				$result = [
					'listing' => $listing,
					'status' => [
						'code' => 200,
						'message' => 'Listing successfully retrived'
					]
				];
			} else {
				$result = [
					'status' => [
						'code' => 404,
						'message' => 'Listing not found'
					]
				];
			}

		} else {
			
			$result = [
				'status' => [
					'code' => 404,
					'message' => 'Parameter not correct'
				]
			];
		}

		return response()->json($result);
	}

	/**
     * Update listing name 
     *
     * @param Request $request
     */
	public function apiUpdateListing(Request $request)
	{
		if ($request->has('listing_id') && $request->has('list_name')) {

    		// Check if listing ID is and user ID is match
			$listing = Listing::where('submitter_id', auth()->user()->id)->where('id', $request->listing_id)->first();

			if (count($listing)) {
				$listing->list_name = $request->list_name;
				$listing->save();

				return response()->json(
					[
						'status' => [
							'code' => 200,
							'message' => 'Listing successfully updated'
						]
					],
					200
				);
			} else {
				return response()->json(
					[
						'status' => [
							'code' => 404,
							'message' => 'Record not found'
						]
					],
					404
				);
			}
		} else {
			return response()->json(
				[
					'status' => [
						'code' => 404,
						'message' => 'Parameter not correct'
					]
				],
				404
			);
		}
	}
}
