<?php

namespace Database\Seeders;

use App\Models\PropertyEnquirie;
use Illuminate\Database\Seeder;

class PropertyEnquirieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => null,
                'property_id' => 1,
                'first_name' => 'Rahim',
                'last_name' => 'Uddin',
                'email' => 'rahim@example.com',
                'phone' => '01712345678',
                'university' => 'University of Dhaka',
                'preferred_move_in_date' => '2026-04-01',
                'preferred_contact_method' => 'email',
                'message' => 'I am interested in this property. Please send more details.',
                'is_student_accommodation' => true,
                'status' => 'new',
            ],
            [
                'user_id' => null,
                'property_id' => 2,
                'first_name' => 'Karim',
                'last_name' => 'Hasan',
                'email' => 'karim@example.com',
                'phone' => '01898765432',
                'university' => 'BRAC University',
                'preferred_move_in_date' => '2026-05-10',
                'preferred_contact_method' => 'phone',
                'message' => 'Looking for a shared apartment near campus.',
                'is_student_accommodation' => true,
                'status' => 'contacted',
            ],
            [
                'user_id' => null,
                'property_id' => 3,
                'first_name' => 'Nusrat',
                'last_name' => 'Jahan',
                'email' => 'nusrat@example.com',
                'phone' => '01922334455',
                'university' => 'North South University',
                'preferred_move_in_date' => '2026-06-15',
                'preferred_contact_method' => 'whatsapp',
                'message' => 'Need female-only accommodation if available.',
                'is_student_accommodation' => true,
                'status' => 'new',
            ],
            [
                'user_id' => null,
                'property_id' => 4,
                'first_name' => 'Tanvir',
                'last_name' => 'Ahmed',
                'email' => 'tanvir@example.com',
                'phone' => '01611223344',
                'university' => 'Independent University Bangladesh',
                'preferred_move_in_date' => '2026-03-25',
                'preferred_contact_method' => 'email',
                'message' => 'Interested in a studio apartment.',
                'is_student_accommodation' => false,
                'status' => 'closed',
            ],
            [
                'user_id' => null,
                'property_id' => 5,
                'first_name' => 'Sadia',
                'last_name' => 'Islam',
                'email' => 'sadia@example.com',
                'phone' => '01555667788',
                'university' => 'East West University',
                'preferred_move_in_date' => '2026-07-01',
                'preferred_contact_method' => 'whatsapp',
                'message' => 'Please share rent details and facilities.',
                'is_student_accommodation' => true,
                'status' => 'contacted',
            ],
        ];

        foreach ($data as $item) {
            PropertyEnquirie::create($item);
        }
    }
}
