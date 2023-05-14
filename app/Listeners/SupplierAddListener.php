<?php

namespace App\Listeners;

use App\Events\SupplierAddEvent;
use App\Models\Supplier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SupplierAddListener
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
    public function handle(SupplierAddEvent $event): void
    {
        //

        foreach ($event->suppliers as $supplier){

            Supplier::create([
                'name'=>$supplier['Name'],
                'phone'=>$supplier['Phone'],
                'town'=>$supplier['Town'],
                'country'=>$supplier['Country'],
                'supermarket_id'=>$event->supermarket->id

            ]);
        }

    }
}
