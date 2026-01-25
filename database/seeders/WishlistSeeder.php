<?php
namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $data = [
            [
                "user_id"     => "2",
                "property_id" => "1",
            ],
            [
                "user_id"     => "2",
                "property_id" => "2",
            ],
            [
                "user_id"     => "2",
                "property_id" => "3",
            ],
            [
                "user_id"     => "2",
                "property_id" => "4",
            ],
            [
                "user_id"     => "3",
                "property_id" => "5",
            ],

        ];

        foreach ($data as $wishlilst) {
            Wishlist::create($wishlilst); // Create
        }
    }
}
