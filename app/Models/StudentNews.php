<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the latest news.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function latestNews()
    {
        return self::orderBy('created_at', 'desc');
    }
}
