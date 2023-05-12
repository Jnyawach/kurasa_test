<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Supermarket;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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


        $supermakets=[
            [
                'name'=>'Quickmart',
                'town'=>'Nairobi',
                'country'=>'Kenya'
            ],
            [
                'name'=>'Naivas',
                'town'=>'Nairobi',
                'country'=>'Kenya'
            ],
            [
                'name'=>'Tuskys',
                'town'=>'Nairobi',
                'country'=>'Kenya'
            ],
            [
                'name'=>'Eastmart',
                'town'=>'Mombasa',
                'country'=>'Kenya'
            ],
            [
                'name'=>'Carrefour',
                'town'=>'Westlands',
                'country'=>'Kenya'
            ]
        ];
        foreach ($supermakets as $supermaket){
            $market=Supermarket::create([
                'name'=>$supermaket['name'],
                'town'=>$supermaket['town'],
                'country'=>$supermaket['country']
            ]);

            for ($x = 0; $x <= 5; $x++) {
                $manager=Manager::create([
                    'name'=>fake()->unique()->name(),
                    'phone'=>fake()->phoneNumber(),
                    'email'=>fake()->unique()->safeEmail(),
                    'supermarket_id'=>$market->id

                ]);
                for ($x = 0; $x <= 10; $x++) {
                    $employees=Employee::create([
                      'name'=>fake()->unique()->name(),
                        'gender'=>fake()->randomElement(['Male','Female']),
                        'type'=>fake()->randomElement(['Cashier','Back Office']),
                        'manager_id'=>$manager->id
                    ]);
                }


            }

            for ($x = 0; $x <= 10; $x++) {
                Supplier::create([
                    'name'=>fake()->company(),
                    'phone'=>fake()->phoneNumber(),
                    'town'=>fake()->randomElement(['Nairobi','Mombasa']),
                    'country'=>'Kenya',
                    'supermarket_id'=>$market->id
                ]);
            }



        }


    }
}
