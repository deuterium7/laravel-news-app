<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function test_home_index()
    {
        $responce = $this->call('GET', 'home');
        $responce->assertViewIs('home');
    }

    public function test_home_send()
    {
        $data = [];
        $responce = $this->call('POST', 'contact/send', $data);
        $responce->assertRedirect('/');
    }
}
