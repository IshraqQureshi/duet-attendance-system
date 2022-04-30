<?php



namespace App\Http\Helpers;

use App\Enums\TeacherQualification;
use App\Enums\Days;
use App\Enums\SubjectType;
use App\Enums\StudentSection;

class GeneralHelper {
    
    public static function getEnumValue($enumName, $enumValue) {       
        $enumInstance = self::getEnumClassInstance($enumName)::fromValue($enumValue);
        return $enumInstance->key;
    }

    public static function getEnumClassInstance($className) {
        switch($className):
            case 'TeacherQualification':
                return 'App\Enums\TeacherQualification';
            case 'Days':
                return 'App\Enums\Days';
            case 'SubjectType':
                return 'App\Enums\SubjectType';
            case 'StudentSection':
                return 'App\Enums\StudentSection';
        endswitch;
    }

}
