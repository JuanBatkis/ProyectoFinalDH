<?php

use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Movie::class, 30)->create();
        /*\DB::table('movies')->insert([
            [
                'title' => 'Spider Man',
                'awards' => 5,
                'release_date' => date('Y-m-d H:i:s'),
                'length' => 350,
                'rating' => 9
            ]
        ]);*/
    }
}
