@extends('layouts.dashboard')

@section('pageContent')
<div class="card">
    <div class="card-header">
        <a href="{{ route('semesters.create') }}" class="btn btn-success">Add Semester</a>
    </div>    
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Department Name</th>
                <th>Actions</th>                
            </tr>
        </thead>
        <tbody>
            @foreach ($semesters as $semester)                
                <tr>
                    <td>{{ $semester->id }}</td>
                    <td>{{ $semester->name }}</td>
                    <td>{{ $semester->department->name }}</td>
                    <td class="d-flex ">
                        <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                        <form method="POST" action="{{ route('semesters.destroy', $semester->id) }}">
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
                <th>Department Name</th>
                <th>Actions</th> 
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection