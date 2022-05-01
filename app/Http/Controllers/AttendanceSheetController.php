<?php

namespace App\Http\Controllers;

use App\Enums\Days;
use App\Enums\StudentSection;
use App\Models\Batch;
use App\Models\Department;
use App\Models\TimeTable;
use Illuminate\Http\Request;

class AttendanceSheetController extends Controller
{
    public $data = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['pageTitle']        = 'Attendance Sheets';
        $this->data['dayID']            = '';
        $this->data['batchID']          = '';
        $this->data['sectionID']        = '';
        $this->data['sections']         = StudentSection::asArray();
        $this->data['batches']          = Batch::all();
        $this->data['days']             = Days::asArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('attendanceSheet.edit', $this->data);
    }

    /**
     * Generate Attendance Sheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $day                            = date('l', strtotime($request->day));
        $dayID                          = Days::fromKey($day)->value;
        
        $this->data['timeTable']        = TimeTable::where('days', $dayID)->get();
        $this->data['sheetDate']        = $request->day;
        $this->data['day']              = $day;
        $this->data['sections']         = ['A' => 1, 'B' => 2, 'C' => 3];

        // dd($this->data['$timeTable']);

        return view('attendanceSheet.sheet', $this->data);
    }
}
