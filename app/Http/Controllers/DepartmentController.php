<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{

    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Departments';
        $this->data['editID'] = '';
        $this->data['departmentName'] = '';
        $this->data['departmentCode'] = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['departments'] = Department::all();        
        return view('departments.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pageTitle'] = 'Add Department';        
        return view('departments.edit', $this->data);
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
            'departmentName' => 'required',
            'departmentCode' => 'required',
        ], [], [
            'departmentName' => 'Department Name',
            'departmentCode' => 'Department Code',
        ]);

        if ($validator->fails()) {
            return redirect(route('departments.create'))
                        ->withErrors($validator)
                        ->withInput();
        } else {            
            try {
                $department = new Department();

                if( isset($request->editID) ):
                    $department = Department::where('id', $request->editID)->first();
                endif;

                $department->name = $request->departmentName;
                $department->code = $request->departmentCode;
                $department->save();

                return redirect(route('departments.index'))->with('success', 'Record(s) saved successfully!');
            } catch (\Exception $e) {
                return redirect(route('departments.index'))->with('error', 'Something went wrong!!');
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
        $editData = Department::where('id', $id)->first();
        $this->data['departmentName'] = $editData->name;
        $this->data['departmentCode'] = $editData->code;
        $this->data['editID'] = $editData->id;

        return view('departments.edit', $this->data);
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
            Department::where('id', $id)->first()->delete();
            return redirect(route('departments.index'))->with('success', 'Record(s) delete successfully!');
        } catch (\Exception $e) {
            return redirect(route('departments.index'))->with('error', 'Something went wrong!!');
        }

    }
}
