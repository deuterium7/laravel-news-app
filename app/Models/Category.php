<?php

namespace App\Models;

use App\Mail\CategoryWasCreated;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'image',
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CategoryWasCreated::class,
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Связываем с таблицей новостей.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
