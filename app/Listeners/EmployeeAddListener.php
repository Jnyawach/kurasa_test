<?php

namespace App\Listeners;

use App\Events\EmployeeAddEvent;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmployeeAddListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmployeeAddEvent $event): void
    {
        //
        foreach ($event->employees as $employee){
            Employee::create([
                'name'=>$employee['Name'],
                'type'=>$employee['Type'],
                'gender'=>$employee['Gender'],
                'manager_id'=>$event->manager->id
            ]);
        }
    }
}
