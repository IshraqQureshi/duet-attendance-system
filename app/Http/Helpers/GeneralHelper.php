<?php



namespace App\Http\Helpers;

use App\Enums\TeacherQualification;
use App\Enums\Days;
use App\Enums\SubjectType;
use App\Enums\StudentSection;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

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

    public static function get_students($batchID, $sectionName) {
        $sections = self::getSectionsGroup($sectionName);
        $students = DB::select(DB::raw("select * from duet_students WHERE `batch_id` = $batchID AND (`section` = $sections[0] OR `section` = $sections[1])"));
        return $students;
    }

    public static function get_students_single($batchID, $sectionID) {
        return Student::where(['batch_id' => $batchID, 'section' => $sectionID])->get();
    }

    public static function getSectionsGroup($sectionName) {
        switch($sectionName):
            case 'A':
                return [StudentSection::fromKey('A1')->value, StudentSection::fromKey('A2')->value];
            case 'B':
                return [StudentSection::fromKey('B1')->value, StudentSection::fromKey('B2')->value];
            case 'C':
                return [StudentSection::fromKey('C1')->value, StudentSection::fromKey('C2')->value];
        endswitch;
    }

}
