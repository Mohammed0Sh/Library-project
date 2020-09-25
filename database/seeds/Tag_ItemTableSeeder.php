<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Tag_ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i=0 ; $i<100 ; $i++)
        {
            DB::table('tag_items')->insert([
                'item_id'=>rand(3,44),
                'tag_id'=>rand(1,11),
            ]);
        }
    }
}
