<?php

namespace App\Imports;

use App\Enums\SubjectType;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {        
        $semester = $row['semester'];
        $teacher = explode(' ', $row['teacher']);
        if( count($teacher) < 2 ):
            $teacher[1] = '';
        endif;
        $department_code = $row['department_code'];
        $department = Department::where('code', 'LIKE', '%'. $department_code .'%')->first();
        $type = SubjectType::fromKey($row['type']);
        try{
            if($department):
                $semester_id = Semester::where('name', 'LIKE', '%'. $semester .'%')->where('department_id', $department->id)->first();
                $teacher_id = Teacher::where('first_name', 'LIKE', '%'. $teacher[0] .'%')->where('last_name', 'LIKE', '%'. $teacher[1] ? $teacher[1] : '' .'%')->first();            
                if($semester_id && $teacher_id):
                    $semester_id = $semester_id->id;
                    $teacher_id = $teacher_id->id;
                else:
                    return [];
                endif;
            else:
                return [];
            endif;
    
        }
        catch(\Exception $e){
            dd($e);
        }

        return new Subject([
            'name'      => $row['name'],
            'type'      => $type,
            'semester_id'  => $semester_id,
            'teacher_id'    => $teacher_id
        ]);
    }
}
