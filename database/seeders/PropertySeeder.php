<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\University;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //universities data
        $uni1 = University::create([
            'name'       => 'University of ABerdeen',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni2 = University::create([
            'name'       => 'University of ABerdeen',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni3 = University::create([
            'name'       => 'University of ABerdeen',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni4 = University::create([
            'name'       => 'University of ABerdeen',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni5 = University::create([
            'name'       => 'University of ABerdeen',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        //property data
        $data = [
            [
                'user_id'         => 3,
                'title'           => 'Modern Studio near University of Nottingham',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => '45 University Road, M13 9PL',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Modern studio apartment located within walking distance to the University of Nottingham.',
                'amenities'       => [7, 8, 9, 10],
                'bill_included'   => [17, 18, 19],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => true,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni1->id, $uni2->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Premium Student Living Studio',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => '12 Oxford Road, M1 7ED',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-08-15',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'A high-standard studio perfect for focused students near campus.',
                'amenities'       => [6, 12],
                'bill_included'   => [16, 20],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => false,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://plus.unsplash.com/premium_photo-1676968002767-1f6a09891350?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni3->id, $uni4->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Cosy Studio Apartment',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => 'Aberdeen Park, AB24 3EE',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Stylish living space with high-speed WiFi and essential amenities.',
                'amenities'       => [7, 10],
                'bill_included'   => [17, 19],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => true,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni1->id, $uni5->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Contemporary Student Studio',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => '88 King Street, Nottingham',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-09-10',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Modern furniture and great natural lighting in a prime location.',
                'amenities'       => [8],
                'bill_included'   => [18],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => false,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni2->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Lenton Green Studio',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => '15 Lenton Blvd, Nottingham',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Spacious studio with a view, close to University of Nottingham.',
                'amenities'       => [8, 9, 11],
                'bill_included'   => [17, 18],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => true,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni1->id, $uni4->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'The Courtyard Studio',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => 'Court Way, NG7 2PH',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-08-20',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Quiet courtyard facing studio for a peaceful study environment.',
                'amenities'       => [6, 9],
                'bill_included'   => [16, 18],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => false,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    =>
                [$uni3->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'High Street Luxury Studio',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => 'High St, Nottingham',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Premium finishes and all bills included for a hassle-free stay.',
                'amenities'       => [7, 8],
                'bill_included'   => [17, 18],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => true,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    =>
                [$uni5->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Student Hub Studio',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => 'Student Lane, NG1 1AA',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-10-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Located right in the center of the student life district.',
                'amenities'       => [10, 11],
                'bill_included'   => [18, 19],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => false,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    =>
                [$uni2->id, $uni3->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Designer Studio Living',
                'category_id'     => 1,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => '9 Design Rd, Nottingham',
                'price'           => 145.00,
                'duration_period' => 'Weekly',
                'available_from'  => '2024-09-05',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Expertly designed studio with modern appliances and sleek interiors.',
                'amenities'       => [7, 12],
                'bill_included'   => [17, 20],
                'lat'             => 52.9547833,
                'lng'             => -1.1581083,
                'is_feature'      => true,
                'is_available'    => true,
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    =>
                [$uni1->id, $uni5->id],
            ],
        ];

        // loop through the data and create properties
        foreach ($data as $item) {
            $universityIds = $item['universities'] ?? [];
            unset($item['universities']);

            $property = Property::create($item);
            if (! empty($universityIds)) {
                $property->universities()->attach($universityIds);
            }
        }
    }
}
