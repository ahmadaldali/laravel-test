<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_create_user()
    {
        $data = [
            'first_name' => 'Ahmad',
            'last_name' => 'Test',
            'email' => 'ahmad@test.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'address' => 'Test Address',
            'phone_number' => '1-222-222-2222'
        ];

        /*  $response = $this->json('POST', '/api/v1/user/create/', $data)
            ->assertStatus(200); */
    }


    public function test_forget_password_failed()
    {
        $response = $this->json('POST', '/api/v1/user/forgot-password')
            ->assertStatus(422);
    }

    public function test_forget_password()
    {
        $data = ['email' => 'ahmad@test.com'];
        $response = $this->json('POST', '/api/v1/user/forgot-password', $data)
            ->assertStatus(200)
            ->assertSee('token');
    }
}