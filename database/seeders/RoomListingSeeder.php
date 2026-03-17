<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Property;
use App\Models\RoomListing;
use Illuminate\Database\Seeder;

class RoomListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Get all Property IDs
        $properties = Property::pluck('id');

        if ($properties->isEmpty()) {
            $this->command->warn("No properties found. Please seed Properties first!");
            return;
        }

        // 2. Fetch Category IDs for room types and amenities
        $roomTypeIds = Category::where('type', 'roomType')->pluck('id')->toArray();
        $amenityIds = Category::where('type', 'amenities')->pluck('id')->toArray();

        // Fallbacks if categories are empty
        $defaultRoomType = !empty($roomTypeIds) ? [$roomTypeIds[0]] : [1];
        $defaultAmenities = !empty($amenityIds) ? array_slice($amenityIds, 0, 3) : [7, 8, 9];

        foreach ($properties as $propertyId) {

            // --- First Room for this property ---
            RoomListing::create([
                'property_id'         => $propertyId,
                'name'                => 'Luxury Studio Suite',
                'description'         => 'High-end studio with modern amenities and a great view.',
                'contract_type'       => 'weekly',
                'move_in_date'        => '2026-09-01',
                'move_out_date'       => '2027-09-01',
                'tenancy_weeks_min'   => 44,
                'tenancy_weeks_max'   => 51,
                'price_per_week'      => 160.00,
                'min_price'           => 150.00,
                'max_price'           => 180.00,
                'is_single_occupancy' => true,
                'is_available'        => true,
                'is_feature'          => true,
                'room_type'           => $defaultRoomType,
                'amenities'           => $defaultAmenities,
                'images'              => ["https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=800"],
            ]);

            // --- Second Room for this property ---
            RoomListing::create([
                'property_id'         => $propertyId,
                'name'                => 'Standard En-suite Room',
                'description'         => 'Affordable and comfortable room perfect for students.',
                'contract_type'       => 'monthly',
                'move_in_date'        => '2026-10-01',
                'move_out_date'       => '2027-06-01',
                'tenancy_weeks_min'   => 24,
                'tenancy_weeks_max'   => 48,
                'price_per_week'      => 120.00,
                'min_price'           => 110.00,
                'max_price'           => 130.00,
                'is_single_occupancy' => true,
                'is_available'        => true,
                'is_feature'          => false,
                'room_type'           => !empty($roomTypeIds) && isset($roomTypeIds[1]) ? [$roomTypeIds[1]] : $defaultRoomType,
                'amenities'           => array_reverse($defaultAmenities), // Just to vary the data
                'images'              => ["https://images.unsplash.com/photo-1616047006789-b7af5afb8c20?q=80&w=800"],
            ]);
        }
    }
}
