@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('batches.store') }} method="post">
        @csrf
        
        <div class="card-body">
            <div class="form-group">
                <label for="batchName">Batch Name</label>
                <input type="text" class="form-control" id="name" name="batchName" placeholder="Enter Batch Name" value="{{ old('batchName') ? old('batchName') : $batchName }}">
                @if ($errors->has('batchName'))
                    <p class="text-danger">{{ $errors->first('batchName') }}</p>
                @endif
            </div>
            <div class="form-group">
              <label>Department</label>
              
              <select class="form-control" name="department_id">
                @foreach ($departments as $department)
                  @php
                      $selected = $departmentID == $department->id ? 'selected' : '';
                  @endphp
                  <option value="{{ $department->id }}" {{ $selected }}>{{ $department->name }}</option>
                @endforeach                  
              </select>
            </div> 
              <div class="form-group">
                <label>Semester</label>                
                <select class="form-control" name="current_semester">
                  @foreach ($semesters as $semester)
                    @php
                        $selected = $semesterID == $semester->id ? 'selected' : '';
                    @endphp
                    <option value="{{ $semester->id }}" {{ $selected }}>{{ $semester->name }} - {{ $semester->department->name }}</option>
                  @endforeach                  
                </select>
              </div>             
            @if( $editID )
                <input type="hidden" name="editID" value="{{ $editID }}">
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Save">
            <a href="{{ route('batches.index') }}" class="btn btn-danger">Back</a>
        </div>
    </form>
  </div>
@endsection