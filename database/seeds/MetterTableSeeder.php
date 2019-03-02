<?php

use Illuminate\Database\Seeder;

class MetterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'name' => 'Organization_' . Str::random(10)
        ]);
    }
}
