<?php

namespace App\Imports;

use App\Enums\SubjectType;
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
        $teacher = $row['teacher'];
        $type = SubjectType::fromKey($row['type']);
        $semester_id = Semester::where('name', 'LIKE', '%'. $semester .'%')->first();
        $teacher_id = Teacher::where('first_name', 'LIKE', '%'. $teacher .'%')->first();

        if($semester_id && $teacher):
            return [];
        else:
            $semester_id = $semester_id->id;
        endif;

        return new Subject([
            'name'      => $row['name'],
            'type'      => $type,
            'semester'  => $semester_id,
            'teacher_id'    => $teacher_id
        ]);
    }
}
