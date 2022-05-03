<?php

namespace App\Http\Controllers;

use App\Imports\BatchImport;
use App\Imports\DepartmentImport;
use App\Imports\SemesterImport;
use App\Imports\StudentImport;
use App\Imports\SubjectImport;
use App\Imports\TeacherImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Import CSV';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {               
        return view('import.view', $this->data);
    }

    /**
     * Display a form for upload csv.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {                       
        $this->data['pageTitle'] = "Import ". strtoupper($name);
        return view('import.edit', $this->data);
    }

    /**
     * Parse Import into CSV model
     * 
     * @return \Illuminate\Http\Response
     */
    public function parseImport(Request $request, $name){

        $validator = Validator::make($request->all(), [
            'csvFile' => 'required|file'            
        ], [], [
            'csvFile' => 'File'
        ]);

        if ($validator->fails()) {
            return redirect(route('import.index'))
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $path = $request->file('csvFile')->getRealPath();
           
            switch($name):
                case 'department':
                    Excel::import(new DepartmentImport, $path);                    
                    break;
                case 'batch':
                    Excel::import(new BatchImport, $path);
                    break;
                case 'semester':
                    Excel::import(new SemesterImport, $path);
                    break;
                case 'subject':
                    Excel::import(new SubjectImport, $path);
                    break;
                case 'teacher':
                    Excel::import(new TeacherImport, $path);
                    break;
                case 'student':
                    Excel::import(new StudentImport, $path);
                    break;
            endswitch;

            return redirect(route('import.index'))->with('success', 'Record(s) imported successfully!');            

        }
        
    }
}
