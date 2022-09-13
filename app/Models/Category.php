<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * Relationship between the Category table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'categories_id', 'id');
    }
}
