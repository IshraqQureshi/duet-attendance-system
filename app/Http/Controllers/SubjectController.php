<?php

namespace App\Http\Controllers;

use App\Enums\SubjectType;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{

    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Subjects';
        $this->data['subjectName'] = '';
        $this->data['semesterID'] = '';
        $this->data['subjectTypeID'] = '';
        $this->data['teacherID'] = '';
        $this->data['subjectTypes'] = SubjectType::asArray();
        $this->data['semesters']  = Semester::all();
        $this->data['teachers']  = Teacher::all();
        $this->data['editID'] = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['subjects'] = Subject::all();        
        return view('subjects.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pageTitle']    = 'Add Subject';
        return view('subjects.edit', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subjectName'       => 'required',
            'type'              => 'required',
            'semester_id'       => 'required',
            'teacher_id'        => 'required',
        ], [], [
            'subjectName'       => 'Subject Name',
            'type'              => 'Type',
            'semester_id'       => 'Semester',
            'teacher_id'        => 'Teacher',
        ]);

        if ($validator->fails()) {
            return redirect(route('subjects.create'))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $subject = new Subject();

                if( isset($request->editID) ):
                    $subject = Subject::where('id', $request->editID)->first();
                endif;

                $subject->name = $request->subjectName;
                $subject->type = $request->type;
                $subject->semester_id = $request->semester_id;
                $subject->teacher_id = $request->teacher_id;
                $subject->save();

                return redirect(route('subjects.index'))->with('success', 'Record(s) saved successfully!');
            } catch (Exception $e) {
                return redirect(route('subjects.index'))->with('error', $e);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Subject::where('id', $id)->first();
        $this->data['subjectName'] = $editData->name;
        $this->data['semesterID'] = $editData->semester_id;
        $this->data['subjectTypeID'] = $editData->type;
        $this->data['teacherID'] = $editData->teacher_id;
        $this->data['editID'] = $editData->id;

        return view('subjects.edit', $this->data);
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
    public function destroy($id)
    {
        try {
            Subject::where('id', $id)->first()->delete();
            return redirect(route('subjects.index'))->with('success', 'Record(s) delete successfully!');
        } catch (Exception $e) {
            return redirect(route('subjects.index'))->with('error', $e);
        }
    }
}
