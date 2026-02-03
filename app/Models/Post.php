<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Post model.
 * Simulates a blog post (WP)
 * 
 * @author Ale Mostajo <https://github.com/amostajo>
 * @version 1.0.0
 */
class Post extends Model
{
    /**
     * Fillable attributes.
     * @since 1.0.0
     * 
     * @var array
     */
    protected $fillable = [
        'game',
        'title',
        'text',
        'tags',
    ];

    /**
     * Hidden attributes.
     * @since 1.0.0
     * 
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attributes that should be cast.
     * @since 1.0.0
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
        ];
    }
}
