@extends('layouts.dashboard')

@section('pageContent')
<div class="card">
    <div class="card-header">
        <a href="{{ route('subjects.create') }}" class="btn btn-success">Add Subject</a>
    </div>    
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Semester</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)                
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ GeneralHelper::getEnumValue('SubjectType', $subject->type) }}</td>
                    <td>{{ $subject->semester->name }} - {{ $subject->semester->department->name }}</td>
                    <td>{{ $subject->teacher->first_name }} {{ $subject->teacher->last_name }}</td>
                    <td class="d-flex ">
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                        <form method="POST" action="{{ route('subjects.destroy', $subject->id) }}">
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
                <th>Type</th>
                <th>Semester</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection