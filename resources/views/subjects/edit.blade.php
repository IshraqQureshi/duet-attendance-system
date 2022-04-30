@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('subjects.store') }} method="post">
        @csrf
        
        <div class="card-body">
            <div class="form-group">
                <label for="subjectName">Name</label>
                <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Enter Subject Name" value="{{ old('subjectName') ? old('subjectName') : $subjectName }}">
                @if ($errors->has('subjectName'))
                    <p class="text-danger">{{ $errors->first('subjectName') }}</p>
                @endif
            </div>            
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="type">
                  @foreach ($subjectTypes as $key => $value)
                    @php
                        $selected = $subjectTypeID == $value ? 'selected' : '';
                    @endphp
                    <option value="{{ $value }}" {{ $selected }}>{{ $key }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Semester</label>
                <select class="form-control" name="semester_id">
                  @foreach ($semesters as $semester)
                    @php
                        $selected = $semesterID == $semester->id ? 'selected' : '';
                    @endphp
                    <option value="{{ $semester->id }}" {{ $selected }}>{{ $semester->name }} - {{ $semester->department->name }}</option>
                  @endforeach                  
                </select>
            </div> 
            <div class="form-group">
                <label>Teacher</label>
                <select class="form-control" name="teacher_id">                    
                  @foreach ($teachers as $teacher)
                    @php
                        $selected = $teacherID == $teacher->id ? 'selected' : '';
                    @endphp
                    <option value="{{ $teacher->id }}" {{ $selected }}>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
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
            <a href="{{ route('teachers.index') }}" class="btn btn-danger">Back</a>
        </div>
    </form>
  </div>
@endsection