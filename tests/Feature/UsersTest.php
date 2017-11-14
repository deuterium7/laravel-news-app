<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithoutMiddleware;

    public function test_user_show()
    {
        $response = $this->call('GET', 'users/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_user_update()
    {
        $response = $this->call('PUT', 'users/1');
        $this->assertEquals(302, $response->status());
    }
}
