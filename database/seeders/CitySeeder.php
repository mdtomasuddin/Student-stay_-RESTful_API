<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name"                 => "Nottingham",
                "image"                => "https://images.unsplash.com/photo-1454793147212-9e7e57e89a4f?q=80&w=664&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "university_name"      => "University of Nottingham, Nottingham Trent",
                "location"             => "Nottingham, UK",
            ],
            [
                "name"                 => "Lenton, Nottingham",
                "image"                => "https://images.unsplash.com/photo-1610818647551-866cce9f06d5?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "university_name"      => "Nottingham Trent University & University of Nottingham",
                "location"             => "Lenton, Nottingham, UK",
            ],
            [
                "name"                 => "Arboretum, Nottingham",
                "image"                => "https://plus.unsplash.com/premium_photo-1671734046130-aa64a701004f?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "university_name"      => "Nottingham Trent University",
                "location"             => "Arboretum, Nottingham, UK",
            ],
            [
                "name"                 => "City Centre, Nottingham",
                "image"                => "https://images.unsplash.com/photo-1639088653566-0434c047faed?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "university_name"      => "Nottingham Trent University & University of Nottingham",
                "location"             => "City Centre, Nottingham, UK",
            ],
            [
                "name"                 => "Beeston, Nottingham",
                "image"                => "https://plus.unsplash.com/premium_photo-1671734046130-aa64a701004f?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "university_name"      => "University of Nottingham",
                "location"             => "Beeston, Nottingham, UK",
            ],
            [
                "name"                 => "Derby",
                "image"                => "https://images.unsplash.com/photo-1572523242409-708ce041d660?q=80&w=1131&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                "university_name"      => "University of Derby",
                "location"             => "Derby, UK",
            ],
        ];

        foreach ($data as $city) {
            City::create($city);
        }
    }
}
