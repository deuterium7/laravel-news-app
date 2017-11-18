<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tests\UserStub;

class UserViewsTest extends TestCase
{
    use UserStub;

    /** @test */
    public function can_show_user_profile_view()
    {
        $profile = User::first();
        $user = $this->createUserStub();

        $this->actingAs($user)
            ->get("users/$profile->id")
            ->assertStatus(200)
            ->assertViewIs('users.show')
            ->assertViewHas('user')
            ->assertViewHas('comments');

        $user->delete();
    }

    /** @test */
    public function can_show_user_ban_view()
    {
        $user = User::first();
        $admin = $this->createUserStub('admin');

        $this->actingAs($admin)
            ->get("users/$user->id/ban")
            ->assertStatus(200)
            ->assertViewIs('users.ban')
            ->assertViewHas('user')
            ->assertSee(trans('catalog.ban'));

        $admin->delete();
    }
}
