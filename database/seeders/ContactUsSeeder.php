<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'full_name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '01711223344',
                'place_of_study_id' => null, // Nullable example
                'budget' => '15000 BDT',
                'preferred_move_in_date' => '2026-06-01',
                'room_type_id' => null,
                'other_preferences' => 'Need a quiet space for studying.',
                'referral_source_id' => null,
                'status' => 'new',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '01899887766',
                'place_of_study_id' => null, // Nullable example
                'budget' => '20000 BDT',
                'preferred_move_in_date' => null,
                'room_type_id' => null,
                'other_preferences' => 'Looking for an attached bath.',
                'referral_source_id' => null,
                'status' => 'contacted',
            ],
            [
                'user_id' => null,
                'full_name' => 'Will Johnson',
                'email' => 'will.j@example.com',
                'phone' => '01655667788',
                'place_of_study_id' => null, 
                'budget' => '12000 BDT',
                'preferred_move_in_date' => '2026-08-15',
                'room_type_id' => null,
                'other_preferences' => 'No specific preference.',
                'referral_source_id' => null,
                'status' => 'new',
            ]
        ];

        foreach ($data as $item) {
            \App\Models\ContactUs::create($item);
        }
    }
}
