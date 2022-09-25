<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title'
    ];

    /**
     * Relationship between the BlogSeries table and the user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationship between the BlogSeries table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'series_id', 'id');
    }
}
