@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('semesters.store') }} method="post">
        @csrf
        
        <div class="card-body">
            <div class="form-group">
                <label for="semesterName">Semester Name</label>
                <input type="text" class="form-control" id="name" name="semesterName" placeholder="Enter Semeter Name" value="{{ old('semesterName') ? old('semesterName') : $semesterName }}">
                @if ($errors->has('semesterName'))
                    <p class="text-danger">{{ $errors->first('semesterName') }}</p>
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
            @if( $editID )
                <input type="hidden" name="editID" value="{{ $editID }}">
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Save">
            <a href="{{ route('semesters.index') }}" class="btn btn-danger">Back</a>
        </div>
    </form>
  </div>
@endsection