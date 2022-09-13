<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_id'
    ];

    /**
     * Relationship between the Bookmark table and the user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Relationship between the Bookmark table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function blogs()
    {
        return $this->belongsTo(Blog::class, 'id', 'blog_id');
    }
}
