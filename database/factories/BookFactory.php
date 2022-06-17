<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'slug' => $this->faker->slug(),
            'source' => $this->faker->text(20),
            'category_id' => mt_rand(1, 3),
            'author' => $this->faker->text(15),
            'publisher' => $this->faker->text(15),
            'published_year' => mt_rand(1901, 2150),
            'stock' => mt_rand(10, 20),
        ];
    }
}
