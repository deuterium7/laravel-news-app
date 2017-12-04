<?php

namespace App\Models;

use App\Mail\UserRegistrationWasConfirmed;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'provider', 'provider_id', 'avatar', 'admin', 'ban',
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserRegistrationWasConfirmed::class,
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'provider', 'provider_id', 'remember_token',
    ];

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
}
