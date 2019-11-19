<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    public function index()
    {
    	$data['user'] = User::paginate(15);

    	return view('admin.users', $data);
    }

    public function form($id = null)
    {
    	if ($id != null) {
    		$data['url'] = 'admin/user/update/' . $id;
    		$data['user'] = User::find($id);
    	} else {
    		$data['url'] = 'admin/user/create';
    		$data['user'] = new User();
    	}

    	return view('admin.users_form', $data);
    }

    public function create(Request $request)
    {
    	// Validate input
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|unique:users,email|email',
			'password' => 'required|min:5',
			'type' => 'required'
		]);

		if ($validator->fails()) {
			return redirect('admin/user/create')
			->withErrors($validator)
			->withInput();
		}

		// Save
		$user = new User;

		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->type = $request->type;

		$user->save();
		
    	return redirect('admin/user')->with('success', 'New user has been created.');
    }

    public function update($id, Request $request)
    {
    	
		// Validate input
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|unique:users,email,' . $id . '|email',
			'password' => 'nullable|min:5',
			'type' => 'required'
		]);

		if ($validator->fails()) {
			return redirect('admin/user/update/' . $id)
			->withErrors($validator)
			->withInput();
		}

		// Update
		$user = User::find($id);

		$user->name = $request->name;
		$user->email = $request->email;

		if (!empty($request->input('password'))) {
			$user->password = bcrypt($request->password);	
		}
		
		$user->type = $request->type;

		$user->save();

		return redirect('admin/user')->with('success', '"' . $user->name . '" record has been updated.');
    }

    public function delete($id)
    {
    	$user = User::find($id);
    	$user->delete();

    	return redirect('admin/user')->with('success', '"' . $user->name . '" record has been deleted.');
    }
}
