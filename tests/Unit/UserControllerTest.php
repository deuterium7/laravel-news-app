<?php

namespace Tests\Unit;

use App\Models\RoleUser;
use Carbon\Carbon;
use Tests\TestCase;
use Tests\UserStub;

class UserControllerTest extends TestCase
{
    use UserStub;

    /** @test */
    public function admin_can_ban_user()
    {
        $admin = $this->createUserStub('admin');
        $user = $this->createUserStub();

        $this->be($admin);
        $this->get('admin/users')
            ->assertStatus(200);

        $this->get("users/$user->id/ban")
            ->assertStatus(200);

        $request = [
            'ban' => Carbon::now()->addHour(),
            '_token' => csrf_token()
        ];

        $user->update($request);

        $this->assertNotEquals(null, $user->ban);

        $user->delete();
        $admin->delete();
    }

    /** @test */
    public function admin_can_give_admin_rights()
    {
        $admin = $this->createUserStub('admin');
        $user = $this->createUserStub();

        $this->be($admin);
        $this->get('admin/users')
            ->assertStatus(200);

        $firstRoles = RoleUser::where('user_id', $user->id)->get();

        $request = [
            'user_id' => $user->id,
            'role_id' => 2,
            '_token' => csrf_token()
        ];

        $this->post("users/$user->id", $request)
            ->assertStatus(302);

        $secondRoles = RoleUser::where('user_id', $user->id)->get();

        $this->assertNotEquals(count($firstRoles), count($secondRoles));

        $user->delete();
        $admin->delete();
    }
}
