<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserSocialAccount extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id', 'provider_user_id', 'provider'
    ];

    /**
     * Устанавливаем связь с таблицей пользователей.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
