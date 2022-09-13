<?php
/**
 * This file is part of the model package.
 *
 * @package model
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 */
class BaseModel extends Model
{
    /**
     * Get table name.
     *
     * @return string
     */
    public static function getTableName()
    {
        return (new static)->getTable();
    }
}
