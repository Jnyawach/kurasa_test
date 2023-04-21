<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTask>
 */
class UserTaskFactory extends Factory
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
            'due_date'=>Carbon::now()->addHours(180),
            'start_time'=>Carbon::now(),
            'user_id'=>fake()->numberBetween(1,3),
            'task_id'=>fake()->numberBetween(1,30),
            'status_id'=>fake()->numberBetween(1,4),


        ];
    }


}
