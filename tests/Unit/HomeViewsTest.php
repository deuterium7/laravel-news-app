<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class HomeViewsTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    /**
     * Базовые значения для теста.
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
        $this->actingAs($this->user);
    }

    /** @test */
    public function the_user_can_see_home_page()
    {
        $this->get('home')
            ->assertStatus(200)
            ->assertSee(trans('catalog.dashboard'));
    }

    /** @test */
    public function the_user_can_see_contact_form_page()
    {
        $this->get('contact')
            ->assertStatus(200)
            ->assertSee(trans('catalog.contactUs'));
    }
}
