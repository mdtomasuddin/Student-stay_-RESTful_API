<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
            DynamicPageSeeder::class,
            SocialMediaSeeder::class,
            ContentSeeder::class,
            FAQSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            BlogSeeder::class,
            PropertySeeder::class,
            // RoomListingSeeder::class,
            DigitalResourceSeeder::class,
            WishlistSeeder::class,
            AgentSeeder::class,
            TestimonialSeeder::class,
            PropertyEnquirieSeeder::class,
            StudentEnquirieSeeder::class,
            CourseSeeder::class,
            VideoSeeder::class,
            RoomListingSeeder::class,
        ]);
    }
}
