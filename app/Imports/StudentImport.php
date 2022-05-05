<?php

namespace App\Imports;

use App\Enums\StudentSection;
use App\Models\Batch;
use App\Models\Department;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $batch = $row['batch'];
        $department_code = $row['department_code'];
        $section = StudentSection::fromKey($row['section'])->value;
        $department = Department::where('code', 'LIKE', '%'. $department_code .'%')->first();
        
        if($department):
            $batch_id = Batch::where('name', 'LIKE', '%'. $batch .'%')->where('department_id', $department->id)->first();
            if($batch_id):
                $batch_id = $batch_id->id;
            else:
                return [];
            endif;
        else:
            return [];            
        endif;

        return new Student([
            'first_name'    => $row['first_name'],
            'last_name'     => $row['last_name'],
            'roll_no'       => $row['roll_no'],
            'section'       => $section,
            'batch_id'      => $batch_id,
        ]);
    }
}
