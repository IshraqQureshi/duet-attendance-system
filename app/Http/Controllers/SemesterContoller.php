<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SemesterContoller extends Controller
{

    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Semesters';
        $this->data['semesterName'] = '';
        $this->data['departmentID'] = '';
        $this->data['departments']  = Department::all();
        $this->data['editID'] = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['semesters'] = Semester::all();        
        return view('semesters.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pageTitle']    = 'Add Semester';  
              
        return view('semesters.edit', $this->data);
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
            'semesterName' => 'required',
            'department_id' => 'required',
        ], [], [
            'semesterName' => 'Semester Name',
            'department_id' => 'Department',
        ]);

        if ($validator->fails()) {
            return redirect(route('semesters.create'))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $semester = new Semester();

                if( isset($request->editID) ):
                    $semester = Semester::where('id', $request->editID)->first();
                endif;

                $semester->name = $request->semesterName;
                $semester->department_id = $request->department_id;
                $semester->save();

                return redirect(route('semesters.index'))->with('success', 'Record(s) saved successfully!');
            } catch (Exception $e) {
                return redirect(route('semesters.index'))->with('error', $e);
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
        $editData = Semester::where('id', $id)->first();
        $this->data['semesterName'] = $editData->name;
        $this->data['departmentID'] = $editData->department_id;
        $this->data['editID'] = $editData->id;

        return view('semesters.edit', $this->data);
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
            Semester::where('id', $id)->first()->delete();
            return redirect(route('semesters.index'))->with('success', 'Record(s) delete successfully!');
        } catch (Exception $e) {
            return redirect(route('semesters.index'))->with('error', $e);
        }
    }
}
