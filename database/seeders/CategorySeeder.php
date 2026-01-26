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

            // Room Types
            ["name" => "Studio Apartment", "type" => "roomType"],
            ["name" => "En-suite Room", "type" => "roomType"],
            ["name" => "1 Bed House", "type" => "roomType"],
            ["name" => "Shared House (2 Bed)", "type" => "roomType"],
            ["name" => "Shared House (3 Bed)", "type" => "roomType"],
            ["name" => "Shared House (4 Bed)", "type" => "roomType"],
            ["name" => "Shared House (5 Bed)", "type" => "roomType"],
            ["name" => "Shared House (6 Bed)", "type" => "roomType"],
            ["name" => "Shared House (7 Bed)", "type" => "roomType"],
            ["name" => "Shared House (8 Bed)", "type" => "roomType"],

            // Place of Study
            ["name" => "Nottingham Trent University", "type" => "placeOfStudy"],
            ["name" => "University of Nottingham", "type" => "placeOfStudy"],
            ["name" => "University of Law", "type" => "placeOfStudy"],
            ["name" => "Confetti Institute of Creative Technologies", "type" => "placeOfStudy"],
            ["name" => "College", "type" => "placeOfStudy"],
            ["name" => "Other", "type" => "placeOfStudy"],

            // How Did You Hear About Us?
            ["name" => "Tiktok", "type" => "referralSource"],
            ["name" => "Snapchat", "type" => "referralSource"],
            ["name" => "Instagram", "type" => "referralSource"],
            ["name" => "Facebook", "type" => "referralSource"],
            ["name" => "BlueSky", "type" => "referralSource"],
            ["name" => "During Street Interview", "type" => "referralSource"],
            ["name" => "AchGoldEstatos Bonus", "type" => "referralSource"],
            ["name" => "Youtube", "type" => "referralSource"],

        ];

        foreach ($data as $categories) {
            Category::create($categories); // Create categories
        }
    }
}
