<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ListingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert some stuff
        $faker = Faker::create();
        DB::table('listing')->insert(
            array(
                'list_name' => 'Starbucks @ Mid valley Megamall',
                'address' => 'Lingkaran Syed Putra, Mid Valley City',
                'latitude' => '3.117880',
                'longitude' => '101.676749',
                'submitter_id' => 2,
                'created_at' => $faker->dateTimeThisMonth(),
                'updated_at' => $faker->dateTimeThisMonth()
            )
        );

        foreach (range(1,50) as $index) {
            $faker = Faker::create();
            DB::table('listing')->insert(
                array(
                    'list_name' => $faker->company,
                    'address' => $faker->address,
                    'latitude' => $faker->latitude,
                    'longitude' => $faker->longitude,
                    'submitter_id' => rand(1, 30),
                    'created_at' => $faker->dateTimeThisMonth(),
                    'updated_at' => $faker->dateTimeThisMonth()
                )
            );
        }
    }
}
