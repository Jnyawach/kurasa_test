<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status;
use Database\Factories\TaskFactory;
use Database\Factories\UserTaskFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Status factory
        \App\Models\Status::factory()->create([
          'name'=>'Pending'
        ]);
        \App\Models\Status::factory()->create([
            'name'=>'Progress'
        ]);
        \App\Models\Status::factory()->create([
            'name'=>'Complete'
        ]);
        \App\Models\Status::factory()->create([
            'name'=>'Cancelled'
        ]);

        //use factory
        \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password'=>Hash::make(12345678)
         ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Two',
            'email' => 'test-two@example.com',
            'password'=>Hash::make(12345678)
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Three',
            'email' => 'test-three@example.com',
            'password'=>Hash::make(12345678)
        ]);

        \App\Models\Task::factory(30)->create();
        \App\Models\UserTask::factory(50)->create();

    }
}
