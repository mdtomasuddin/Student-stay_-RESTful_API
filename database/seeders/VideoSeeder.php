<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $videos = [
            ['module_id' => 1, 'title' => 'Introduction to AchGoldEstates', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 2, 'title' => 'Understanding the Context', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 3, 'title' => 'Stage 0: How to Improvise', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 4, 'title' => 'Stage 1: Monetization Strategy', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 5, 'title' => 'Stage 2: Advertising Basics', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 6, 'title' => 'Stage 3: Stabilizing Business', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 7, 'title' => 'Stage 4: Setting Priorities', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 8, 'title' => 'Stage 5: Creating Products', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 9, 'title' => 'Stage 6: Optimization Process', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 10, 'title' => 'Stage 7: Categorizing Data', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 11, 'title' => 'Stage 8: Specialist Niche', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 12, 'title' => 'Stage 9: Capitalization Plan', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
            ['module_id' => 13, 'title' => 'Final Bonus: Extra Resources', 'link' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/c7V9B_5mvQY?si=bHrZZkXghlVNW9Xy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
