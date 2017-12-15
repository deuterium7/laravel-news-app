<?php

namespace App\Models;

use App\Mail\ArticleWasCreated;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'category_id', 'user_id', 'title', 'image', 'body', 'visibility', 'favorite',
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ArticleWasCreated::class,
    ];

    /**
     * Связываем с таблицей категорий.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Связываем с таблицей пользователей.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
