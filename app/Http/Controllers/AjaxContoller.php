<?php

namespace App\Http\Controllers;

use App\Enums\Days;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\TimeTable;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;

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

        $modifiedData = [];
        foreach($data as $key => $value){
            $value['teacherName'] = $value['first_name'] .' '. $value['last_name'];
            $modifiedData[] = $value;
        }

        return $modifiedData;
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
        // dd($data);
        $modifiedData = [];
        foreach($data as $key => $value){
            $value['id'] = $value['id'];
            $value['sujectName'] = $value['name'] .' - '. GeneralHelper::getEnumValue('SubjectType', $value['type']);
            $modifiedData[] = $value;
        }
        return $modifiedData;
    }

    /**
     * Get Department Of Timetable Day
     * 
     * @param int day
     * 
     * @return Array
     */
    public function get_department(Request $request) {
        $day                            = date('l', strtotime($request->day));
        $dayID                          = Days::fromKey($day)->value;
        $timeTable = TimeTable::where('days', $dayID)->distinct('department_id')->get();        
        
        $modifiedData = [];
        foreach($timeTable as $key => $value){
            $data = [];
            $data['id'] = $value->department_id;
            $data['name'] = $value->department->name;
            $modifiedData[] = $data;
        }
        
        return GeneralHelper::my_array_unique($modifiedData, true);
    }

    /**
     * Get Department Of Timetable Day
     * 
     * @param int day
     * 
     * @return Array
     */
    public function get_batch(Request $request) {
        $department_id                            = $request->department_id;
        $batches = TimeTable::where('department_id', $department_id)->get();        
        $modifiedData = [];
        foreach($batches as $key => $value){
            $data = [];
            $data['id'] = $value->batch_id;
            $data['name'] = $value->batch->name;
            $modifiedData[] = $data;
        }
        return GeneralHelper::my_array_unique($modifiedData, true);
    }

    /**
     * Get Semester List By Department
     * 
     * @param int department_id
     * 
     * @return Array
     */
    public function get_subject_attendance(Request $request) {
        $subjects = TimeTable::where('batch_id', $request->batchID)->with(['subject'])->get()->toArray();
        // dd($data);
        $modifiedData = [];
        foreach($subjects as $key => $value){
            $data = [];
            $data['id'] = $value['subject']['id'];
            $data['sujectName'] = $value['subject']['name'] .' - '. GeneralHelper::getEnumValue('SubjectType', $value['subject']['type']);
            $modifiedData[] = $data;
        }
        return $modifiedData;
    }
    
    /**
     * Get Semester List By Department
     * 
     * @param int department_id
     * 
     * @return Array
     */
    public function get_sections(Request $request) {
        $timeTables = Timetable::where('subject_id', $request->subject_id)->get()->toArray();

        $modifiedData = [];
        foreach($timeTables as $key => $value){
            $data = [];
            $data['id'] = $value['section_id'];
            $data['section'] = GeneralHelper::getEnumValue('StudentSection', $value['section_id']);
            $modifiedData[] = $data;
        }
        return GeneralHelper::my_array_unique($modifiedData, true);
    }

    /**
     * Get Semester List By Department
     * 
     * @param int department_id
     * 
     * @return Array
     */
    public function mark_attendance(Request $request) {
        
        try{
            foreach($request->students as $key => $value) {

                $attendance = new Attendance();
                $recordExisit = Attendance::where([
                    'department_id' => $request->department_id,
                    'batch_id'  => $request->batch_id,
                    'subject_id'    => $request->subject_id,
                    'section_id'    => $request->section_id,
                    'student_id'    => $key,
                    'date'          => date('Y-m-d', strtotime($request->date))
                ])->first();
                if($recordExisit):
                    $attendance = $recordExisit;
                endif;
    
                $attendance->department_id = $request->department_id;
                $attendance->batch_id = $request->batch_id;
                $attendance->subject_id = $request->subject_id;
                $attendance->student_id = $key;
                $attendance->section_id = $request->section_id;
                $attendance->date = date('Y-m-d', strtotime($request->date));
                
                $attendance->status = $value;
    
                $attendance->save();
            }
            return json_encode([
                'status' => true
            ]);
        } catch(\Exception $e) {
            dd($e);
            return json_encode([
                'status' => false
            ]);
        }


    }

    

}
