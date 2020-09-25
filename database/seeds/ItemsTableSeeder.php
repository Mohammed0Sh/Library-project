<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i=0 ; $i<400 ; $i++)
        {
            DB::table('items')->insert([
                'name'=>$faker->text($maxNvchars = 50),
                'desc'=>$faker->text,
                'item_type_id'=>rand(1,3),
                'subject_id'=>rand(1,3),
                'maintainer_id'=>rand(1,3),
                'item_state_id'=>rand(1,4),
            ]);
        }
    }
}
