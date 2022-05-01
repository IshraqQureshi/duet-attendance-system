@extends('layouts.dashboard')

@section('pageContent')
<div class="card">    
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action={{ route('attendance-sheet.generate') }} method="post">
        @csrf
        
        <div class="card-body">
            
            <div class="form-group">
                <label>Date</label>
                <input type="text" class="form-control days" id="day" name="day" placeholder="Select Date">
                @if ($errors->has('day'))
                    <p class="text-danger">{{ $errors->first('day') }}</p>
                @endif
            </div>            

            

            {{-- @if( $editID )
                <input type="hidden" name="editID" value="{{ $editID }}">
            @endif --}}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Generate">            
        </div>
    </form>
  </div>
@endsection