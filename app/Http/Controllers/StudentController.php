<?php

namespace App\Http\Controllers;

use App\Enums\StudentSection;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Students';
        $this->data['first_name'] = '';
        $this->data['last_name'] = '';
        $this->data['roll_no'] = '';
        $this->data['batchID'] = '';
        $this->data['sectionID'] = '';
        $this->data['sections'] = StudentSection::asArray();
        $this->data['batches']  = Batch::all();
        $this->data['editID'] = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['students'] = Student::all();        
        return view('students.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pageTitle']    = 'Add Student';
        return view('students.edit', $this->data);
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
            'section'       => 'required',
            'batch_id'      => 'required',
            'roll_no'       => 'required'
        ], [], [
            'first_name'    => 'First Code',
            'last_name'     => 'Last Name',
            'section'       => 'Section',
            'batch_id'      => 'Batch',
            'roll_no'       => 'Roll No'
        ]);

        if ($validator->fails()) {
            return redirect(route('students.create'))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $student = new Student();

                if( isset($request->editID) ):
                    $student = Student::where('id', $request->editID)->first();
                endif;                

                $student->first_name = $request->first_name;
                $student->last_name = $request->last_name;
                $student->section = $request->section;
                $student->roll_no = $request->roll_no;
                $student->batch_id = $request->batch_id;
                $student->save();

                return redirect(route('students.index'))->with('success', 'Record(s) saved successfully!');
            } catch (Exception $e) {
                return redirect(route('students.index'))->with('error', $e);
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
        $editData = Student::where('id', $id)->first();
        $this->data['first_name'] = $editData->first_name;
        $this->data['last_name'] = $editData->last_name;
        $this->data['roll_no'] = $editData->roll_no;
        $this->data['batchID'] = $editData->batch_id;
        $this->data['sectionID'] = $editData->section;
        $this->data['editID'] = $editData->id;

        return view('students.edit', $this->data);
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
            Student::where('id', $id)->first()->delete();
            return redirect(route('students.index'))->with('success', 'Record(s) delete successfully!');
        } catch (Exception $e) {
            return redirect(route('students.index'))->with('error', $e);
        }
    }
}
