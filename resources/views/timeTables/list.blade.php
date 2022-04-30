@extends('layouts.dashboard')

@section('pageContent')
<div class="card">       
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Department</th>
                <th>Batch</th>
                <th>Semester</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($batches as $batch)                
                <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->department->name }}</td>
                    <td>{{ $batch->name }}</td>
                    <td>{{ $batch->semester->name }}</td>
                    <td class="d-flex ">
                        <a href="{{ route('time-table.view', $batch->id) }}" class="btn btn-warning btn-sm mr-2">View</a>                        
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Department</th>
                <th>Batch</th>
                <th>Actions</th> 
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection