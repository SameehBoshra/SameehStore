<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;use Illuminate\Support\Str;

class CategoryFactory extends Factory
{

    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->word; // Generate a random category name

        return [
            'name' => $name,
            'slug' => Str::slug($name), // Generate a slug from the name
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
        ];   $name = $this->faker->word; // Generate a random category name

        return [
            'name' => $name,
            'slug' => Str::slug($name), // Generate a slug from the name
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
        ];   $name = $this->faker->word; // Generate a random category name

        return [
            'name' => $name,
            'slug' => Str::slug($name), // Generate a slug from the name
            'is_active' => $this->faker->boolean(), // 80% chance of being active
        ];
    }

}



/* $factory->define(Category::class,function(Faker $faker)
{
    return [

        'name'=>$faker->word(),
        'slug'=>$faker->slug(),
        'is_active'=>$faker->boolean()

    ];
}); */
