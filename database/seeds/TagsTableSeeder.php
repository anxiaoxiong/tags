<?php

use Illuminate\Database\Seeder;
use App\Models\Tags;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tags::create([
            'name'=>'Bills included'
        ]);
    }
}
