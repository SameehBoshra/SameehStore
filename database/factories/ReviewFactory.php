<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Str;

class ReviewFactory extends Factory
{

    protected $model = Review::class;

    public function definition(): array
    {
        $name = $this->faker->word; // Generate a random category name

        return [
            'customer' => $this->faker->text(30),
            'product' => $this->faker->text(60),
            'review' => $this->faker->randomElement(['1 Star', ' 2 Star', ' 3 Star', ' 4 Star', ' 5 Star']),

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
