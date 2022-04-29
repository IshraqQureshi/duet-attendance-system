@extends('layouts.dashboard')

@section('pageContent')
<div class="card">
    <div class="card-header">
        <a href="{{ route('batches.create') }}" class="btn btn-success">Add Batch</a>
    </div>    
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Department Name</th>
                <th>Current Semester</th>
                <th>Actions</th>                
            </tr>
        </thead>
        <tbody>
            @foreach ($batches as $batch)
                <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->name }}</td>
                    <td>{{ $batch->department->name }}</td>
                    <td>{{ $batch->semester->name }}</td>
                    <td class="d-flex ">
                        <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                        <form method="POST" action="{{ route('batches.destroy', $batch->id) }}">
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
                <th>Current Semester</th>
                <th>Actions</th> 
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection