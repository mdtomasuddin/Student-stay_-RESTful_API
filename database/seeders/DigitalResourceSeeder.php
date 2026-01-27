<?php

namespace Database\Seeders;

use App\Models\DigitalResource;
use Illuminate\Database\Seeder;

class DigitalResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'type'        => 'pdf',
                'title'       => 'Free Ebook on Laravel 12',
                'image'       => 'https://images.unsplash.com/photo-1454793147212-9e7e57e89a4f?q=80&w=664&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'description' => 'A comprehensive guide to mastering Laravel 12 for beginners.',
                'file_path'   => 'uploads/DigitalResources/laravel12_guide.pdf',
            ],
            [
                'type'        => 'pdf',
                'title'       => 'Advanced React Techniques',
                'image'       => 'https://images.unsplash.com/photo-1768879051946-4984246ed043?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'description' => 'Deep dive into React hooks, context, and performance optimization.',
                'file_path'   => 'uploads/DigitalResources/react_advanced.pdf',
            ],
            [
                'type'        => 'video_url',
                'title'       => '5 M.D. Students Model Nottingham Student Safety Training',
                'image'       => 'https://plus.unsplash.com/premium_photo-1767721104232-357575b597f6?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'description' => 'Lorem ipsum dolor sit amet consectetur. Elit tellus suspendisse pretium in amet morbi in eget. Arcu eget amet nulla sapien sed diam. Sodales tellus eget consequat elementum sociis neque id. Orci pellentesque dui quis neque tellus est. Sit quis fringilla tristique odio. Dignissim sapien at posuere.',
                'external_url' => 'https://youtu.be/revG7Hf_Ifc',
            ],
        ];

        foreach ($data as $city) {
            DigitalResource::create($city);
        }
    }
}
