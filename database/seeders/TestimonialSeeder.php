<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name"     => "Hannah Schmitt",
                "position" => "Msc Student",
                "image"    => "https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80",
                "message"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis.",
            ],
            [
                "name"     => "Jenny Wilson",
                "position" => "Bsc Student",
                "image"    => "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=150&q=80",
                "message"  => "Finding the right resources for my thesis was incredibly easy using this platform. It has completely changed how I approach my academic research.",
            ],
            [
                "name"     => "Guy Hawkins",
                "position" => "College Student",
                "image"    => "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80",
                "message"  => "The community support here is unmatched. Whenever I hit a roadblock in my projects, there's always someone ready to help.",
            ],
            [
                "name"     => "Robert Fox",
                "position" => "PhD Candidate",
                "image"    => "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=150&q=80",
                "message"  => "Managing complex data sets and collaborating with peers has never been more seamless. This is an essential tool for any serious researcher.",
            ],
            [
                "name"     => "Esther Howard",
                "position" => "Bsc Student",
                "image"    => "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80",
                "message"  => "I love the intuitive interface. It didn't take any time at all to learn how to navigate the system and get my work started.",
            ],
            [
                "name"     => "Cameron Williamson",
                "position" => "Msc Student",
                "image"    => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80",
                "message"  => "The variety of tools available under one roof is impressive. It has saved me dozens of hours that I used to spend switching between apps.",
            ],
            [
                "name"     => "Jane Cooper",
                "position" => "High School Senior",
                "image"    => "https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=150&q=80",
                "message"  => "Even as a high school student, I find the advanced features accessible and extremely helpful for my college prep courses.",
            ],
            [
                "name"     => "Wade Warren",
                "position" => "Graduate Assistant",
                "image"    => "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80",
                "message"  => "This platform bridges the gap between theory and practice. My students find the interactive modules incredibly engaging.",
            ],
        ];

        foreach ($data as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name']],
                $testimonial
            );
        }
    }
}
