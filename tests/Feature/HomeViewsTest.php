<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\UserStub;

class HomeViewsTest extends TestCase
{
    use UserStub;

    /** @test */
    public function can_show_dashboard_view()
    {
        $user = $this->createUserStub();

        $this->actingAs($user)
            ->get('home')
            ->assertStatus(200)
            ->assertViewIs('home')
            ->assertSee(trans('catalog.dashboard'));

        $user->delete();
    }

    /** @test */
    public function can_show_contact_view()
    {
        $user = $this->createUserStub();

        $this->actingAs($user)
            ->get('contact')
            ->assertStatus(200)
            ->assertViewIs('contact')
            ->assertSee(trans('catalog.contactUs'));

        $user->delete();
    }
}
