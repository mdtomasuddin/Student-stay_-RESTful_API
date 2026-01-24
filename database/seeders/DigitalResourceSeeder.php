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
                
            ],
        ];

        foreach ($data as $city) {
            DigitalResource::create($city);
        }
    }
}
