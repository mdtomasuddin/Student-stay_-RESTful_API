<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "full_name"                => "Badhon Roy",
                "letting_agent_name"       => "Doe Lettings",
                "email"                    => "partner@gmail.com",
                "phone"                    => "07123456789",
                "city_id"                  => 1,
                "source"                   => "Google Search",
                "properties_managed_count" => "10",
                "date"                     => "2023-06-01",
                "time"                     => "10:00:00",
                "notes"                    => "Interested in long-term partnership.",
                "ip_address"               => "127.0.0.1",
                "status"                   => "approved",
            ],
            [
                "full_name"                => "Jane Smith",
                "letting_agent_name"       => "Smith Rentals",
                "email"                    => "jane@smithrentals.co.uk",
                "phone"                    => "07234567890",
                "city_id"                  => 2,
                "source"                   => "Facebook Ad",
                "properties_managed_count" => "10",
                "date"                     => "2023-06-05",
                "time"                     => "14:30:00",
                "notes"                    => "Requires more info on pricing.",
                "ip_address"               => "192.168.1.1",
                "status"                   => "pending",
            ],

        ];

        foreach ($data as $agentData) {
            Agent::create($agentData);
        }
    }
}
