<?php

namespace App\Http\Controllers;

use App\Enums\Days;
use App\Enums\StudentSection;
use App\Models\Batch;
use App\Models\Department;
use App\Models\Subject;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Time;

class TimeTableController extends Controller
{

    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['pageTitle']            = 'Time Table';       
        $this->data['departmentID']         = '';
        $this->data['batchID']              = '';
        $this->data['subjectID']            = '';
        $this->data['dayID']                = '';
        $this->data['startTime']            = '';
        $this->data['endTime']              = '';
        $this->data['sectionID']            = '';
        $this->data['days']                 = Days::asArray();
        $this->data['sections']             = StudentSection::asArray();
        $this->data['subjects']             = Subject::all();
        $this->data['departments']          = Department::all();
        $this->data['batches']              = Batch::all();
        $this->data['editID']               = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['batches'] = Batch::all();        
        return view('timeTables.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->data['pageTitle']    = 'Add TimeTable';
        $this->data['batchID'] = $id;
        return view('timeTables.edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject_id'    => 'required',
            'day'           => 'required',
            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',
            'section_id'    => 'required'
        ], [], [
            'subject_id'    => 'Subject',
            'day'     => 'Day',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'section_id'    => 'Section'
        ]);

        if ($validator->fails()) {
            return redirect(route('time-table.batch.create', ['batchID' => $id]))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $timeTable = new TimeTable();

                if( isset($request->editID) ):
                    $timeTable = TimeTable::where('id', $request->editID)->first();
                endif;

                $departmentID = Batch::where('id', $id)->first()->department_id; 

                $timeTable->department_id = $departmentID;
                $timeTable->batch_id = $id;
                $timeTable->subject_id = $request->subject_id;
                $timeTable->days = $request->day;
                $timeTable->start_time = $request->start_time;
                $timeTable->end_time = $request->end_time;
                $timeTable->section_id = $request->section_id;
                $timeTable->save();

                return redirect(route('time-table.view', ['batchID' => $id]))->with('success', 'Record(s) saved successfully!');
            } catch (\Exception $e) {
                return redirect(route('time-table.view', ['batchID' => $id]))->with('error', 'Something went wrong!!');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $batch          = Batch::where('id', $id)->first();
        $this->data['pageTitle'] = $batch->name .' - '. $batch->department->name;
        $this->data['timeTables'] = TimeTable::where('batch_id', $id)->get();
        $this->data['batchID'] = $id;
        return view('timeTables.view', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($batchID, $id)
    {
        $editData = TimeTable::where('id', $id)->first();
        $this->data['departmentID'] = $editData->department_id;
        $this->data['batchID'] = $editData->batch_id;
        $this->data['subjectID'] = $editData->subject_id;
        $this->data['dayID'] = $editData->days;
        $this->data['startTime'] = $editData->start_time;
        $this->data['endTime'] = $editData->end_time;
        $this->data['sectionID'] = $editData->section_id;
        $this->data['editID'] = $editData->id;
        
        return view('timeTables.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($batchID, $id)
    {
        try {
            TimeTable::where('id', $id)->first()->delete();
            return redirect(route('time-table.view', ['batchID' => $batchID]))->with('success', 'Record(s) delete successfully!');
        } catch (\Exception $e) {
            return redirect(route('time-table.view', ['batchID' => $batchID]))->with('error', 'Something went wrong!!');
        }
    }
}
