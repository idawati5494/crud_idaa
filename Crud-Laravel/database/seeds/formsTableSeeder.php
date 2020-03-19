<?php

use Illuminate\Database\Seeder;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $forms=[
            [
                'title' =>'MA',
                'description' =>'bbbbbbbbbbbbbbbbbbbbbbbbb',
            ],
            [
                'title' =>'SMT',
                'description' =>'bbbbbbbbbbbbbbbbbbbbbbbbb',
            ],
            [
                'title' =>'ME',
                'description' =>'bbbbbbbbbbbbbbbbbbbbbbbbb',
            ],
            [
                'title' =>'SA',
                'description' =>'bbbbbbbbbbbbbbbbbbbbbbbbb'
            ],
         ];
    DB::table('forms')->insert($forms);
    }
}
