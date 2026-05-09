<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'                   => 1,
                'first_name'           => 'admin',
                'last_name'            => 'admin',
                'email'                => 'admin@admin.com',
                'avatar'               => null,
                'email_verified_at'    => Carbon::now(),
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'admin',
                'referral_code'        => '132456',
                'status'               => 'active',
                'cover_photo'          => "backend/images/users/cover_image.png",
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 2,
                'first_name'           => 'Sadharon',
                'last_name'            => 'Student',
                'email'                => 'user@gmail.com',
                'avatar'               => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGF2YXRhcnxlbnwwfHwwfHx8MA%3D%3D',
                'email_verified_at'    => Carbon::now(),
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'user',
                'referral_code'        => '111456',
                'status'               => 'active',
                'cover_photo'          => "backend/images/users/cover_image.png",
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 3,
                'first_name'           => 'Badhon',
                'last_name'            => 'Roy',
                'email'                => 'partner@gmail.com',
                'avatar'               => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGF2YXRhcnxlbnwwfHwwfHx8MA%3D%3D',
                'email_verified_at'    => Carbon::now(),
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'agent',
                'referral_code'        => '122256',
                'status'               => 'active',
                'cover_photo'          => "backend/images/users/cover_image.png",
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'id'                   => 4,
                'first_name'           => 'Jony',
                'last_name'            => 'Depp',
                'email'                => 'customer@gmail.com',
                'avatar'               => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGF2YXRhcnxlbnwwfHwwfHx8MA%3D%3D',
                'email_verified_at'    => Carbon::now(),
                'password'             => Hash::make('12345678'),
                'terms_and_conditions' => true,
                'role'                 => 'agent',
                'referral_code'        => '132556',
                'status'               => 'active',
                'cover_photo'          => "backend/images/users/cover_image.png",
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}
