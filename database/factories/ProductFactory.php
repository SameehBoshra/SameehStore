<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->word; // Generate a random category name

        return [
            'name' => $this->faker->text(60) ,
            'description' => $this->faker->text(150),
            'price' => $this->faker->numberBetween(10,9000),
            'manage_stock' =>  false,
            'in_stock' =>  $this->faker->boolean(),
            'sku' =>  $this->faker->unique()->word(),
            'slug' =>  $this->faker->slug(), // Generate a slug from the name
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'dty'=>$this->faker->numberBetween(0,1000),
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
