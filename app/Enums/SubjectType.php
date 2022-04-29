<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SubjectType extends Enum
{
    const Lab       =   1;
    const Theory    =   2;    
}
