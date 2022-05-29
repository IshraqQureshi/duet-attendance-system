@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('attendance.students') }} method="post">
        @csrf
        
        <div class="card-body">
            
            <div class="form-group">
                <label>Date</label>
                <input type="text" class="form-control days days_attendance_select" id="day" name="day" placeholder="Select Date">
                @if ($errors->has('day'))
                    <p class="text-danger">{{ $errors->first('day') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Department</label>
                <select class="form-control department_attendance_select" name="department_id" data-selected="{{ $departmentID }}">                    
                  <option>Please Select</option>
                </select>
            </div>

            <div class="form-group">
                <label>Batch</label>
                <select class="form-control batch_attendance_select" name="batch_id" data-selected="{{ $batchID }}">                    
                  <option>Please Select</option>
                </select>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <select class="form-control subject_attendance_select" name="subject_id" data-selected="{{ $subjectID }}">
                  <option>Please Select</option>
                </select>
            </div>

            <div class="form-group">
                <label>Section</label>
                <select class="form-control section_attendance_select" name="section_id" data-selected="{{ $sectionID }}">
                  <option>Please Select</option>
                </select>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Get Students">            
        </div>
    </form>
  </div>
@endsection