<?php

namespace Tests\Unit;

use Tests\TestCase;

class SocialsTest extends TestCase
{
    public function test_social_login()
    {
        $response = $this->call('GET', 'social/google');
        $this->assertEquals(302, $response->status());
    }
}
