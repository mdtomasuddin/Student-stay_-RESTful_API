<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('social_media')->insert([
            [
                'id'           => 1,
                'social_media' => 'facebook',
                'profile_link' => 'https://www.facebook.com/',
                'created_at'   => '2025-02-19 00:03:21',
                'updated_at'   => '2025-03-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 2,
                'social_media' => 'instagram',
                'profile_link' => 'https://www.instagram.com/',
                'created_at'   => '2025-04-19 00:03:21',
                'updated_at'   => '2025-05-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 3,
                'social_media' => 'twitter',
                'profile_link' => 'https://x.com/',
                'created_at'   => '2025-06-19 00:03:21',
                'updated_at'   => '2025-07-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 4,
                'social_media' => 'linkedin',
                'profile_link' => 'https://www.linkedin.com/',
                'created_at'   => '2025-08-19 00:03:21',
                'updated_at'   => '2025-09-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 5,
                'social_media' => 'tiktok',
                'profile_link' => 'https://www.tiktok.com/',
                'created_at'   => '2025-08-19 00:03:21',
                'updated_at'   => '2025-09-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 6,
                'social_media' => 'snapchat',
                'profile_link' => 'https://www.snapchat.com/',
                'created_at'   => '2025-10-19 00:03:21',
                'updated_at'   => '2025-11-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 7,
                'social_media' => 'youtube',
                'profile_link' => 'https://www.youtube.com/',
                'created_at'   => '2025-12-19 00:03:21',
                'updated_at'   => '2026-01-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 8,
                'social_media' => 'pinterest',
                'profile_link' => 'https://www.pinterest.com/',
                'created_at'   => '2026-02-19 00:03:21',
                'updated_at'   => '2026-03-19 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 9,
                'social_media' => 'whatsapp',
                'profile_link' => 'https://www.whatsapp.com/',
                'created_at'   => '2026-04-19 00:03:21',
                'updated_at'   => '2026-04-24 00:03:21',
                'deleted_at'   => null,
            ],
            [
                'id'           => 10,
                'social_media' => 'telegram',
                'profile_link' => 'https://telegram.org/',
                'created_at'   => '2026-04-25 00:03:21',
                'updated_at'   => '2026-05-19 00:03:21',
                'deleted_at'   => null,
            ],
        ]);
    }
}
