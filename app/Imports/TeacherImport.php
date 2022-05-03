<?php

namespace App\Imports;

use App\Enums\TeacherQualification;
use App\Models\Department;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel, WithHeadingRow  
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $department_code = $row['department_code'];
        $qualification = TeacherQualification::fromKey($row['qualification']);
        $department_id = Department::where('code', 'LIKE', '%'. $department_code .'%')->first();

        if($department_id && $qualification):
            $qualification = $qualification->value;
            $department_id = $department_id->id;
        else:
            return [];
        endif;

        return new Teacher([
            'first_name'    => $row['first_name'],
            'last_name'    => $row['last_name'],
            'qualification'    => $qualification,
            'department_id'    => $department_id,
        ]);
    }
}
