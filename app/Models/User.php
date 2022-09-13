<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'phone',
        'role',
        'avatar',
        'blogger',
        'email_verified_at',
        'email_verify_code',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The password attributes will be encrypted.
     *
     * @param string $value The value to encrypt.
     *
     * @return string
     */
    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = (string) Hash::make($value);

        return true;
    }

    /**
     * Relationship between the user table and the user profiles table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Relationship between the user table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }

    /**
     * Relationship between the user table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function blogSeries()
    {
        return $this->hasMany(BlogSeries::class, 'user_id', 'id');
    }

    /**
     * Relationship between the user table and the blog table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(BlogSeries::class, 'user_id', 'id');
    }

    /**
     * Relationship between the user table and the comment table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relationship between the user table and the follow table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers()
    {
        return $this->hasMany(Follow::class, 'from_user_id', 'id');
    }

    /**
     * Relationship between the user table and the follow table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function following()
    {
        return $this->hasMany(Follow::class, 'to_user_id', 'id');
    }

    /**
     * Relationship between the user table and the favorite table
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }
}
