@extends('layouts.dashboard')

@section('pageContent')
<div class="card">        
    <div class="card-header">
        <button type="button" class="btn btn-success present_mark_btn">Mark As Present</button>
        <input type="hidden" name="department_id" value="{{ $department_id }}">
        <input type="hidden" name="batch_id" value="{{ $batch_id }}">
        <input type="hidden" name="section_id" value="{{ $section_id }}">
        <input type="hidden" name="subject_id" value="{{ $subject_id }}">
        <input type="hidden" name="date" value="{{ $date }}">
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Batch</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $key => $value)
                <tr>
                    <td><input type="checkbox" name="studentID" value="{{ $value['id'] }}" {{ $value['status'] == 'Present' ? 'checked' : ($value['status'] == 'Absent' ? 'text-danger' : 'checked') }}></td>
                    <td>{{ $value['first_name'] }} {{ $value['last_name'] }}</td>
                    <td>{{ $value['roll_no'] }}</td>
                    <td>{{ $value['batch']['name'] }}</td>
                    <td class="{{ $value['status'] == 'Present' ? 'text-success' : ($value['status'] == 'Absent' ? 'text-danger' : 'text-warning') }}">{{ $value['status'] }}</td>
                </tr>
            @endforeach            
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Batch</th>
                <th>Status</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection