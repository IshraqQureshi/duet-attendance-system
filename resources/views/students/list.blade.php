@extends('layouts.dashboard')

@section('pageContent')
<div class="card">
    <div class="card-header">
        <a href="{{ route('students.create') }}" class="btn btn-success">Add Student</a>
    </div>    
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Section</th>
                <th>Batch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)                
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ GeneralHelper::getEnumValue('StudentSection', $student->section) }}</td>
                    <td>{{ $student->batch->name }}</td>
                    <td class="d-flex ">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                        <form method="POST" action="{{ route('students.destroy', $student->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">                            
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Section</th>
                <th>Batch</th>
                <th>Actions</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection