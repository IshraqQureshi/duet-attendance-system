<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Semester;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchesController extends Controller
{
    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Batches';
        $this->data['batchName'] = '';
        $this->data['departmentID'] = '';
        $this->data['semesterID'] = '';
        $this->data['semesters'] = Semester::all();
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
        $this->data['batches'] = Batch::all();        
        return view('batches.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pageTitle']    = 'Add Batch';  
              
        return view('batches.edit', $this->data);
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
            'batchName' => 'required',
            'department_id' => 'required',
            'current_semester' => 'required'
        ], [], [
            'batchName' => 'Batch Name',
            'department_id' => 'Department',
            'current_semester' => 'Current Semester'
        ]);

        if ($validator->fails()) {
            return redirect(route('batches.create'))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $batch = new Batch();

                if( isset($request->editID) ):
                    $batch = Batch::where('id', $request->editID)->first();
                endif;

                $batch->name = $request->batchName;
                $batch->department_id = $request->department_id;
                $batch->current_semester = $request->current_semester;
                $batch->save();

                return redirect(route('batches.index'))->with('success', 'Record(s) saved successfully!');
            } catch (\Exception $e) {
                return redirect(route('batches.index'))->with('error', 'Something went wrong!!');
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
        $editData = Batch::where('id', $id)->first();        
        $this->data['batchName'] = $editData->name;
        $this->data['departmentID'] = $editData->department_id;
        $this->data['semesterID'] = $editData->current_semester;
        $this->data['editID'] = $editData->id;

        return view('batches.edit', $this->data);
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
            Batch::where('id', $id)->first()->delete();
            return redirect(route('batches.index'))->with('success', 'Record(s) delete successfully!');
        } catch (\Exception $e) {
            return redirect(route('batches.index'))->with('error', 'Something went wrong!!');
        }
    }
}
