<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserViewsTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var User
     */
    protected $admin;

    /**
     * @var int
     */
    protected $userId;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
        $this->admin = factory(User::class)->make(['admin' => true]);
        $this->userId = User::first()->id;
    }

    /** @test */
    public function the_user_can_see_profile_page()
    {
        $this->actingAs($this->user)
            ->get("users/$this->userId")
            ->assertStatus(200);
    }

    /** @test */
    public function the_admin_can_see_user_ban_page()
    {
        $this->actingAs($this->admin)
            ->get("users/$this->userId/ban")
            ->assertStatus(200)
            ->assertSee(trans('catalog.ban'));
    }
}
