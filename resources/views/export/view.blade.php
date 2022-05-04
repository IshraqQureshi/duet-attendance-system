@extends('layouts.dashboard')

@section('pageContent')
<div class="card">      
    <!-- /.card-header -->
    <div class="card-body">        
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Export Data</h4>
            </div>
            <div class="col-md-3">
                <a href="{{ route('export.process') }}" class="btn btn-warning">Export</a>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
  </div>
@endsection