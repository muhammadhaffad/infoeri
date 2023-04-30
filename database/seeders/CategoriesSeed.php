<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => "Workshop", 
                'dateCreated' => new \DateTime,
                'dateUpdated' => null,
            ], 
            [
                'name' => "Seminar", 
                'dateCreated' => new \DateTime,
                'dateUpdated' => null,
            ], 
            [
                'name' => "Lomba", 
                'dateCreated' => new \DateTime,
                'dateUpdated' => null,
            ],
            [
                'name' => "Show", 
                'dateCreated' => new \DateTime,
                'dateUpdated' => null,
            ], 
            [
                'name' => "Music", 
                'dateCreated' => new \DateTime,
                'dateUpdated' => null,
            ]
        ];
    
        \DB::table('categories')->insert($categories);
    }
}
