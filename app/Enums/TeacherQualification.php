<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TeacherQualification extends Enum
{
    const Dr    =   1;
    const Engr  =   2;
    const Mr   =   3;
    const Mrs   =   4;
    const Miss   =   5;
}
