<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15),
            'slug' => $this->faker->slug(),
            'grade_id' => mt_rand(1,2),
            'number' => mt_rand(1,30),
            'book_id' => mt_rand(1,20),
            'borrow_date' => $this->faker->date(),
            'back_date' => $this->faker->date(),
        ];
    }
}
