<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use WithoutMiddleware;

    public function test_home_index()
    {
        $responce = $this->call('GET', 'home');
        $this->assertEquals(200, $responce->status());
    }

    public function test_home_send()
    {
        $data = [];
        $responce = $this->call('POST', 'contact/send', $data);
        $responce->assertRedirect('/');
    }
}
