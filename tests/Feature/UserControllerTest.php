<?php

namespace Tests\Unit;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithoutEvents, DatabaseTransactions;

    /**
     * @var User
     */
    protected $admin;

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

        $this->admin = factory(User::class)->make(['admin' => true]);
        $this->be($this->admin);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function the_admin_can_ban_user()
    {
        $this->get('users/'.$this->user->id.'/ban')
            ->assertStatus(200);

        $request = [
            'ban'    => Carbon::now()->addHour(),
            '_token' => csrf_token(),
        ];

        $this->user->update($request);

        $this->assertNotEquals(null, $this->user->ban);
    }

    /** @test */
    public function the_admin_can_give_admin_rights()
    {
        $this->get('admin/users')
            ->assertStatus(200);

        $firstRole = $this->user->admin;

        $request = [
            'admin'    => true,
            '_token'   => csrf_token(),
        ];

        $this->user->update($request);

        $secondRole = $this->user->admin;

        $this->assertNotEquals($firstRole, $secondRole);
    }
}
