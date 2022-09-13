<?php
/**
 * This file is part of the bensampo/laravel-enum
 *
 * @package bensampo/laravel-enum
 */

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Role of user
 */
final class UserRole extends Enum
{
    const USER = 1;
    const ADMIN = 2;
}
