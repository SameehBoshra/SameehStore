<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::factory()->count(20)->create();
    }
}
