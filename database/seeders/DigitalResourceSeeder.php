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
                'description' => 'A comprehensive guide to mastering Laravel 12 for beginners.',
                'file_path'   => 'uploads/DigitalResources/laravel12_guide.pdf',
            ],
            [
                'type'        => 'pdf',
                'title'       => 'Advanced React Techniques',
                'description' => 'Deep dive into React hooks, context, and performance optimization.',
                'file_path'   => 'uploads/DigitalResources/react_advanced.pdf',
            ],
            [
                'type'        => 'video_url',
                'title'       => '5 M.D. Students Model Nottingham Student Safety Training',
                'description' => 'Lorem ipsum dolor sit amet consectetur. Elit tellus suspendisse pretium in amet morbi in eget. Arcu eget amet nulla sapien sed diam. Sodales tellus eget consequat elementum sociis neque id. Orci pellentesque dui quis neque tellus est. Sit quis fringilla tristique odio. Dignissim sapien at posuere.',
                'external_url' => 'https://youtu.be/revG7Hf_Ifc',
            ],
        ];

        foreach ($data as $city) {
            DigitalResource::create($city);
        }
    }
}
