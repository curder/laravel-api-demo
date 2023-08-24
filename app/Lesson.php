<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 */
class Lesson extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
