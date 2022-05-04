<?php

namespace App\Http\Controllers;

use App\Enums\TeacherQualification;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Teachers';
        $this->data['first_name'] = '';
        $this->data['last_name'] = '';
        $this->data['departmentID'] = '';
        $this->data['qualificationID'] = '';
        $this->data['departments']  = Department::all();
        $this->data['qualifications'] = TeacherQualification::asArray();
        $this->data['editID'] = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['teachers'] = Teacher::all();        
        return view('teachers.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pageTitle']    = 'Add Teacher';
        return view('teachers.edit', $this->data);
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
            'first_name'    => 'required',
            'last_name'     => 'required',
            'department_id' => 'required',
            'qualification' => 'required',
        ], [], [
            'first_name'    => 'First Name',
            'last_name'     => 'Last Name',
            'department_id' => 'Department',
            'qualification' => 'Qualification',
        ]);

        if ($validator->fails()) {
            return redirect(route('teachers.create'))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $teacher = new Teacher();

                if( isset($request->editID) ):
                    $teacher = Teacher::where('id', $request->editID)->first();
                endif;

                $teacher->first_name = $request->first_name;
                $teacher->last_name = $request->last_name;
                $teacher->qualification = $request->qualification;
                $teacher->department_id = $request->department_id;
                $teacher->save();

                return redirect(route('teachers.index'))->with('success', 'Record(s) saved successfully!');
            } catch (\Exception $e) {
                return redirect(route('teachers.index'))->with('error', 'Something went wrong!!');
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
        $editData = Teacher::where('id', $id)->first();
        $this->data['first_name'] = $editData->first_name;
        $this->data['last_name'] = $editData->last_name;
        $this->data['qualificationID'] = $editData->qualification;
        $this->data['departmentID'] = $editData->department_id;
        $this->data['editID'] = $editData->id;

        return view('teachers.edit', $this->data);
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
            Teacher::where('id', $id)->first()->delete();
            return redirect(route('teachers.index'))->with('success', 'Record(s) delete successfully!');
        } catch (\Exception $e) {
            return redirect(route('teachers.index'))->with('error', 'Something went wrong!!');
        }
    }
}
