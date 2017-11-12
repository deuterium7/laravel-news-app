<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Связываем с таблицей ролей.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Связываем с таблицей новостей.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Связываем с таблицей комментариев.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Проверяем есть ли данная роль у пользователя.
     *
     * @param $check
     *
     * @return bool
     */
    public function hasRole($check)
    {
        return in_array($check, array_pluck($this->roles->toArray(), 'slug'));
    }

    /**
     * Создать пользователя провайдером.
     *
     * @param $providerUser
     *
     * @return mixed
     */
    public static function createBySocialProvider($providerUser)
    {
        $user = self::create([
            'email'    => $providerUser->getEmail(),
            'name'     => $providerUser->getName(),
            'password' => bcrypt('secret'.Carbon::now()),
        ]);

        DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

        return $user;
    }
}
