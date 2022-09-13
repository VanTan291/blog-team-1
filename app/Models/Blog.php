<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'categories_id',
        'series_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'description',
        'views',
        'favorites',
        'is_published',
    ];

    /**
     * Relationship between the favorite table and the user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Relationship between the blog table and the blogSeries table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(BlogSeries::class, 'id', 'series_id');
    }

    /**
     * Relationship between the blog table and the comment table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id');
    }

    /**
     * Relationship between the blog table and the tag table
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Relationship between the blog table and the favorite table
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */
    public function favorite()
    {
        return $this->morphOne(Favorite::class, 'favoriteable');
    }

    /**
     * Relationship between the blog table and the category table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'categories_id');
    }

    /**
     * Relationship between the blog table and the bookmark table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'blog_id', 'id');
    }
}
