<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name"                 => "Guides",
                "type"             => "blogCategory",
            ],
            [
                "name"                 => "City Guides",
                "type"             => "blogCategory",
            ],
            [
                "name"                 => "Finance",
                "type"             => "blogCategory",
            ],
            [
                "name"                 => "Moving Tips",
                "type"             => "blogCategory",
            ],
            [
                "name"                 => "Student Life",
                "type"             => "blogCategory",
            ],
        ];

        foreach ($data as $city) {
            Category::create($city);
        }
    }
}
