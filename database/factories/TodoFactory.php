<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'status' => $this->faker->passthrough(mt_rand(1, 6)),
            'title' => $this->faker->text(),
            'start_datetime' => $this->faker->dateTime(),
            'end_datetime' => $this->faker->dateTimeThisYear('+1 month'),
            'archived_datetime' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
