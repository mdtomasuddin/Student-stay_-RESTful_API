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
            // property type category
            ["name" => "Studio", "type" => "propertyType"],
            ["name" => "Flat", "type" => "propertyType"],
            ["name" => "En suite", "type" => "propertyType"],
            ["name" => "Non - En suite", "type" => "propertyType"],
            ["name" => "Shared House", "type" => "propertyType"],

            // Amenities Category
            ["name" => "WiFi", "type" => "amenities"],
            ["name" => "Gym", "type" => "amenities"],
            ["name" => "Laundry", "type" => "amenities"],
            ["name" => "Study Area", "type" => "amenities"],
            ["name" => "Bike Storage", "type" => "amenities"],
            ["name" => "24/7 Security", "type" => "amenities"],
            ["name" => "En-suite", "type" => "amenities"],
            ["name" => "Parking", "type" => "amenities"],
            ["name" => "Bills Included", "type" => "amenities"],
            ["name" => "Common Room", "type" => "amenities"],

            //billIncluded Category
            ["name" => "Gas", "type" => "billIncluded"],
            ["name" => "Electricity", "type" => "billIncluded"],
            ["name" => "Broadband", "type" => "billIncluded"],
            ["name" => "TV License", "type" => "billIncluded"],
            ["name" => "Water", "type" => "billIncluded"],
            ["name" => "Council Tax", "type" => "billIncluded"],

            //Blog Categories
            ["name" => "Guides", "type" => "blogCategory"],
            ["name" => "City Guides", "type" => "blogCategory"],
            ["name" => "Finance", "type" => "blogCategory"],
            ["name" => "Moving Tips", "type" => "blogCategory"],
            ["name" => "Student Life", "type" => "blogCategory"],

        ];

        foreach ($data as $categories) {
            Category::create($categories); // Create categories
        }
    }
}
