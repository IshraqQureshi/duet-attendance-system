<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Batch;

class AjaxContoller extends Controller
{
    /**
     * Get Semester List By Department
     * 
     * @param int department_id
     * 
     * @return Array
     */
    public function get_semester(Request $request) {
        
        $data = Semester::where('department_id', $request->department_id)->get()->toArray();

        return $data;
    }
    
    /**
     * Get Semester List By Department
     * 
     * @param int department_id
     * 
     * @return Array
     */
    public function get_teacher(Request $request) {
        
        $semester = Semester::where('id', $request->semester_id)->first();
        $data = Teacher::where('department_id', $semester->department_id)->get()->toArray();

        return $data;
    }

    /**
     * Get Semester List By Department
     * 
     * @param int department_id
     * 
     * @return Array
     */
    public function get_subject(Request $request) {
        $batch = Batch::where('id', $request->batchID)->first();
        $data = Subject::where('semester_id', $batch->current_semester)->get()->toArray();

        return $data;
    }
}
