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
                "full_name"                => "John Doe",
                "letting_agent_name"       => "Doe Lettings",
                "email"                    => "john@example.com",
                "phone"                    => "07123456789",
                "city_id"                  => 1,
                "source"                   => "Google Search",
                "properties_managed_count" => "10",
                "date"                     => "2023-06-01",
                "time"                     => "10:00:00",
                "notes"                    => "Interested in long-term partnership.",
                "ip_address"               => "127.0.0.1",
                "status"                   => "verified",
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
            [
                "full_name"                => "Robert Brown",
                "letting_agent_name"       => "Brown & Co",
                "email"                    => "robert@brownco.com",
                "phone"                    => "07345678901",
                "city_id"                  => 1,
                "source"                   => "Word of Mouth",
                "properties_managed_count" => "100",
                "date"                     => "2023-07-12",
                "time"                     => "09:15:00",
                "notes"                    => "Top tier agent in the North.",
                "ip_address"               => "10.0.0.5",
                "status"                   => "approved",
            ],
            [
                "full_name"                => "Emily White",
                "letting_agent_name"       => "White Estates",
                "email"                    => "emily@whiteestates.com",
                "phone"                    => "07456789012",
                "city_id"                  => 3,
                "source"                   => "LinkedIn",
                "properties_managed_count" => "50-100",
                "date"                     => "2023-08-20",
                "time"                     => "11:00:00",
                "notes"                    => "Wants to integrate via API.",
                "ip_address"               => "172.16.254.1",
                "status"                   => "pending",
            ],
            [
                "full_name"                => "Michael Scott",
                "letting_agent_name"       => "Scranton Realty",
                "email"                    => "michael@scranton.com",
                "phone"                    => "07567890123",
                "city_id"                  => 2,
                "source"                   => "Instagram",
                "properties_managed_count" => "5",
                "date"                     => "2023-09-01",
                "time"                     => "16:45:00",
                "notes"                    => "Follow up requested next week.",
                "ip_address"               => "8.8.8.8",
                "status"                   => "rejected",
            ],
        ];

        foreach ($data as $agentData) {
            Agent::create($agentData);
        }
    }
}
