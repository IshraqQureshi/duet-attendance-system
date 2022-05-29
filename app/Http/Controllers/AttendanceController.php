<?php

namespace App\Http\Controllers;

use App\Enums\Days;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Enums\StudentSection;

class AttendanceController extends Controller
{
    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle']        = 'Attendance';
        $this->data['dayID']            = '';
        $this->data['batchID']          = '';
        $this->data['sectionID']        = '';
        $this->data['sections']         = StudentSection::asArray();
        $this->data['batches']          = Batch::all();
        $this->data['days']             = Days::asArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['departmentID'] = '';
        $this->data['batchID'] = '';
        $this->data['subjectID'] = '';
        $this->data['sectionID'] = '';
        return view('attendance.edit', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function students(Request $request)
    {
        $batch_id = $request->batch_id;
        $section_id = $request->section_id;
        $department_id = $request->department_id;
        $subject_id = $request->subject_id;
        $date = $request->day;
        
        $students = Student::where(
            ['batch_id' => $batch_id, 'section' => $section_id]
        )->with('batch')->get()->toArray();
        $this->data['batch_id'] = $batch_id;
        $this->data['section_id'] = $section_id;
        $this->data['department_id'] = $department_id;
        $this->data['subject_id'] = $subject_id;
        $this->data['date'] = $date;

        $attendance = Attendance::where([
            'department_id' => $department_id,
            'batch_id'  => $batch_id,
            'subject_id'    => $subject_id,
            'section_id'    => $section_id,
            'date'          => date('Y-m-d', strtotime($request->day))
        ])->get();

        foreach($students as $key => $value) {
            $value['status'] = 'Not Marked';
            if(count($attendance) > 0) {
                foreach( $attendance as $data ) {
                    if($value['id'] == $data->student_id && $data->status ): 
                        $value['status'] = 'Present';
                        break;
                    else:  $value['status'] = 'Absent';
                    endif;
                }
            }
            $this->data['students'][] = $value;
        }


        return view('attendance.students', $this->data);

    }

    
}
