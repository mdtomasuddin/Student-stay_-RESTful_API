<?php

namespace Database\Seeders;

use App\Models\StudentEnquirie;
use Illuminate\Database\Seeder;

class StudentEnquirieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 2,
                'full_name' => 'Rahim Uddin',
                'email' => 'rahim@example.com',
                'phone' => '01712345678',
                'ip_address' => '192.168.1.10',
                'preferred_move_in_date' => null,
                'message' => 'I am interested in student accommodation near the university.',
                'status' => 'new',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Karim Hasan',
                'email' => 'karim@example.com',
                'phone' => '01898765432',
                'ip_address' => '192.168.1.11',
                'preferred_move_in_date' => '2026-05-10',
                'message' => 'Looking for a shared room with affordable rent.',
                'status' => 'contacted',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Nusrat Jahan',
                'email' => 'nusrat@example.com',
                'phone' => '01922334455',
                'ip_address' => '192.168.1.12',
                'preferred_move_in_date' => '2026-06-15',
                'message' => 'Need a female-only accommodation close to campus.',
                'status' => 'new',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Tanvir Ahmed',
                'email' => 'tanvir@example.com',
                'phone' => '01611223344',
                'ip_address' => '192.168.1.13',
                'preferred_move_in_date' => '2026-03-25',
                'message' => 'Interested in studio apartments for students.',
                'status' => 'closed',
            ],
            [
                'user_id' => 2,
                'full_name' => 'Sadia Islam',
                'email' => 'sadia@example.com',
                'phone' => '01555667788',
                'ip_address' => '192.168.1.14',
                'preferred_move_in_date' => null,
                'message' => 'Please provide details about available student housing.',
                'status' => 'contacted',
            ],
        ];

        foreach ($data as $item) {
            StudentEnquirie::create($item);
        }
    }
}
