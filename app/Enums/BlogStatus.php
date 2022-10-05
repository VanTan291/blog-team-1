<?php
/**
 * This file is part of the bensampo/laravel-enum
 *
 * @package bensampo/laravel-enum
 */

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * Status of user
 */
final class BlogStatus extends Enum implements LocalizedEnum
{
    const ACTIVE = 1;
    const IN_ACTIVE = 2;
}//end class
