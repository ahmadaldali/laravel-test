<?php

namespace Tests\Unit;

use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_get_orders_failed()
    {
        $this->json('GET', '/api/v1/orders')
            ->assertStatus(401); //no auth
    }
}