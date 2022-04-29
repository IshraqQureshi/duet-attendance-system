@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('departments.store') }} method="post">
        @csrf
        
        <div class="card-body">
            <div class="form-group">
                <label for="departmentName">Department Name</label>
                <input type="text" class="form-control" id="name" name="departmentName" placeholder="Enter Department Name" value="{{ old('departmentName') ? old('departmentName') : $departmentName }}">
                @if ($errors->has('departmentName'))
                    <p class="text-danger">{{ $errors->first('departmentName') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="departmentCode">Department Code</label>
                <input type="text" class="form-control" id="code" name="departmentCode" placeholder="Enter Department Code" value="{{ old('departmentCode') ? old('departmentCode') : $departmentCode }}">
                @if ($errors->has('departmentCode'))
                    <p class="text-danger">{{ $errors->first('departmentCode') }}</p>
                @endif
            </div>
            @if( $editID )
                <input type="hidden" name="editID" value="{{ $editID }}">
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Save">
            <a href="{{ route('departments.index') }}" class="btn btn-danger">Back</a>
        </div>
    </form>
  </div>
@endsection