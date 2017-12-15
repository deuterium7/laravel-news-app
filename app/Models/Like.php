<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'comment_id',
        'user_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Связываем с таблицей комметариев.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        $this->belongsTo(Comment::class);
    }
}
