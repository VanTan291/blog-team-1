<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'mail_notification',
    ];

    /**
     * Relationship between the favorite table and the user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'id', 'from_user_id');
    }

    /**
     * Relationship between the favorite table and the user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id', 'to_user_id');
    }
}
