@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('students.store') }} method="post">
        @csrf
        
        <div class="card-body">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') ? old('first_name') : $first_name }}">
                @if ($errors->has('first_name'))
                    <p class="text-danger">{{ $errors->first('first_name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') ? old('last_name') : $last_name }}">
                @if ($errors->has('last_name'))
                    <p class="text-danger">{{ $errors->first('last_name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="roll_no">Roll No</label>
                <input type="text" class="form-control" id="roll_no" name="roll_no" placeholder="Enter Roll No" value="{{ old('roll_no') ? old('roll_no') : $roll_no }}">
                @if ($errors->has('roll_no'))
                    <p class="text-danger">{{ $errors->first('roll_no') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Section</label>
                <select class="form-control" name="section">
                  @foreach ($sections as $key => $value)
                    @php
                        $selected = $sectionID == $value ? 'selected' : '';
                    @endphp
                    <option value="{{ $value }}" {{ $selected }}>{{ $key }}</option>
                  @endforeach                  
                </select>
            </div>
            <div class="form-group">
                <label>Batch</label>
                <select class="form-control" name="batch_id">
                  @foreach ($batches as $batch)
                    @php
                        $selected = $batchID == $batch->id ? 'selected' : '';
                    @endphp
                    <option value="{{ $batch->id }}" {{ $selected }}>{{ $batch->name }}</option>
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