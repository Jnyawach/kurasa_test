<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'=>fake()->sentence(6 ),
            'status_id'=>fake()->numberBetween(1,4),
            'description'=>fake()->sentence(20),
            'due_date'=>Carbon::now()->addHours(72);
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
}
