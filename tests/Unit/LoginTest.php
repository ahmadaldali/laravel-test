<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_main_admin()
    {
        Session::start();
        $response = $this->call('POST', '/api/v1/admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_failed_login()
    {
        Session::start();
        $response = $this->call('POST', '/api/v1/admin/login', [
            'email' => 'ahmad@ahmad.ahmad',
            'password' => 'wrong_password',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function test_login_missing_password()
    {
        Session::start();
        $response = $this->call('POST', '/api/v1/admin/login', [
            'email' => 'ahmad@ahmad.ahmad',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(422, $response->getStatusCode());
    }
}