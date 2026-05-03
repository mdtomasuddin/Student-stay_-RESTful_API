<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('system_settings')->insert([
            [
                'id'             => 1,
                'title'          => 'AchGoldEstates',
                'system_name'    => 'AchGoldEstates',
                'email'          => 'info@support.com',
                'phone'          => '01100000000',
                'address'        => 'Dhaka, Dhaka, Bangladesh',
                'copyright_text' => '©copy right AchGoldEstates',
                'description'    => '<p>About System...</p>',
                'logo'           => null,
                'favicon'        => null,
                'created_at'     => '2024-12-08 05:08:00',
                'updated_at'     => '2024-12-08 05:08:00',
            ],
        ]);
    }
}
