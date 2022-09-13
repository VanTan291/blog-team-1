<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * Relationship between the tag table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphedByMany
     */
    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }
}
