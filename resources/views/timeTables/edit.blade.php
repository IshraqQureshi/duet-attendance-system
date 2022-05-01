@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('time-table.batch.store', ['batchID' => $batchID]) }} method="post">
        @csrf
        
        <div class="card-body">
            <div class="form-group">
                <label>Subject</label>
                <select class="form-control" name="subject_id">
                  @foreach ($subjects as $subject)
                    @php
                        $selected = $subjectID == $subject->id ? 'selected' : '';
                    @endphp
                    <option value="{{ $subject->id }}" {{ $selected }}>{{ $subject->name }} - {{ GeneralHelper::getEnumValue('SubjectType', $subject->type) }}</option>
                  @endforeach                  
                </select>
            </div>   
            <div class="form-group">
                <label>Day</label>
                <select class="form-control" name="day">
                  @foreach ($days as $key => $value)
                    @php
                        $selected = $dayID == $value ? 'selected' : '';
                    @endphp
                    <option value="{{ $value }}" {{ $selected }}>{{ $key }}</option>
                  @endforeach                  
                </select>
            </div>
            <div class="form-group">
                <label>Section</label>
                <select class="form-control" name="section_id">
                  @foreach ($sections as $key => $value)
                    @php
                        $selected = $sectionID == $value ? 'selected' : '';
                    @endphp
                    <option value="{{ $value }}" {{ $selected }}>{{ $key }}</option>
                  @endforeach                  
                </select>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Enter Start Time" value="{{ old('start_time') ? old('start_time') : $startTime }}">
                @if ($errors->has('start_time'))
                    <p class="text-danger">{{ $errors->first('start_time') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="start_time">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" placeholder="Enter Start Time" value="{{ old('end_time') ? old('end_time') : $endTime }}">
                @if ($errors->has('end_time'))
                    <p class="text-danger">{{ $errors->first('end_time') }}</p>
                @endif
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