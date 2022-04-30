@extends('layouts.dashboard')

@section('pageContent')
<div class="card">
    <div class="card-header">
        <a href="{{ route('time-table.batch.create', ['batchID' => $batchID]) }}" class="btn btn-success">Add Time Table</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="dataTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Day</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timeTables as $timeTable)                
                <tr>
                    <td>{{ $timeTable->id }}</td>
                    <td>{{ $timeTable->subject->name }}</td>
                    <td>{{ GeneralHelper::getEnumValue('Days', $timeTable->days) }}</td>
                    <td>{{ date('h:i A', strtotime($timeTable->start_time)) }} - {{ date('h:i A', strtotime($timeTable->end_time)) }}</td>
                    <td class="d-flex ">
                        <a href="{{ route('time-table.batch.edit', ['batchID' => $batchID, 'id' => $timeTable->id]) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                        <form method="POST" action="{{ route('time-table.batch.destroy', ['batchID' => $batchID, 'id' => $timeTable->id]) }}">
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
                <th>Subject</th>
                <th>Day</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection