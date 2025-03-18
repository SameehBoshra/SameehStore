<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{

    protected $model = Order::class;

    public function definition(): array
    {
        $name = $this->faker->word; // Generate a random category name

        return [
            'order' => $this->faker->buildingNumber(),
            'customer' => $this->faker->text(30),
            'price' => $this->faker->numberBetween(20000, 150000),
            'orderStatus' => $this->faker->randomElement(['Complete', 'Not Complete']),

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
