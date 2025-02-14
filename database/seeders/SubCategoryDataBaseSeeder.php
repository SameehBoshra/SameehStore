<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoryDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(5)->create([
            'parent_id'=>$this->getRandomParentId(),
        ]);
    }
    public function getRandomParentId()
    {
        $random = \App\Models\Category::inRandomOrder()->first();
        return $random;
    }
}
