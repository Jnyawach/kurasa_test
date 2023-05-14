<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupermarketTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_supermarket(): void
    {
        $supermarket1=$this->post('/supermarket',
            [
                'name'=>'Test Supermarket',
                'town'=>'Nairobi',
                'country'=>'Kenya'
            ]
        );

        $this->assertTrue(true);
    }
}
