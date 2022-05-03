<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Semester;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BatchImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $department_code = $row['department_code'];
        $semester_name = $row['current_semester'];

        $department_id = Department::where('code', 'LIKE', '%'. $department_code .'%')->first();
        $current_semester = Semester::where('name', 'LIKE', '%'. $semester_name .'%')->first();

        if( $department_id && $current_semester ):
            $department_id = $department_id->id;
            $current_semester = $current_semester->id;
        else:
            return [];
        endif;
        
        return new Batch([
            'name'  => $row['name'],
            'department_id' => $department_id,
            'current_semester'  => $current_semester    
        ]);
    }
}
