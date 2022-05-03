<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Semester;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SemesterImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {        
        $department_code = $row['department_code'];
        $department_id = Department::where('code', 'LIKE', '%'. $department_code .'%')->first()->id;

        if($department_id):
            $department_id = $department_id->id;
        else:
            return [];
        endif;
        
        return new Semester([
            'name'  => $row['name'],
            'department_id' => $department_id,
        ]);        
    }
}
