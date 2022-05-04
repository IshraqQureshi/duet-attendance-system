<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;

class ExportController extends Controller
{
    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle'] = 'Export CSV';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {               
        return view('export.view', $this->data);
    }

    /**
     * Export students data
     * 
     */
    public function export()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
        // return redirect(route('export.index'))->with('success', 'Record(s) exported successfully!');
    }
}
