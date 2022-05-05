@extends('layouts.dashboard')

@section('pageContent')
<div class="card">      
    <!-- /.card-header -->
    <div class="card-body">
        @if ($errors->has('csvFile'))
            <p class="text-danger">{{ $errors->first('csvFile') }}</p>
        @endif
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Import Departments</h4>
            </div>
            <div class="col-md-5">
                <form method="post" action="{{ route('import.parse', ['name' => 'department']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="csvFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="input-group-text" type="submit" value="Upload">
                            </div>
                        </div>
                    </div>     
                </form>               
            </div>
            <div class="col-md-3">
                <a href="/import-samples/departments.csv" download="departments.csv" class="btn btn-warning">Sample CSV</a>
            </div>
        </div>

        <div class="vr"></div>
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Import Batches</h4>
            </div>
            <div class="col-md-5">
                <form method="post" action="{{ route('import.parse', ['name' => 'batch']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="csvFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="input-group-text" type="submit" value="Upload">
                            </div>
                        </div>
                    </div>     
                </form>               
            </div>
            <div class="col-md-3">
                <a href="/import-samples/batches.csv" download="batches.csv" class="btn btn-warning">Sample CSV</a>
            </div>
        </div>
        
        <div class="vr"></div>
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Import Semester</h4>
            </div>
            <div class="col-md-5">
                <form method="post" action="{{ route('import.parse', ['name' => 'semester']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="csvFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="input-group-text" type="submit" value="Upload">
                            </div>
                        </div>
                    </div>     
                </form>               
            </div>
            <div class="col-md-3">
                <a href="/import-samples/semesters.csv" download="semesters.csv" class="btn btn-warning">Sample CSV</a>
            </div>
        </div>
        
        <div class="vr"></div>
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Import Subjects</h4>
            </div>
            <div class="col-md-5">
                <form method="post" action="{{ route('import.parse', ['name' => 'subjects']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="csvFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="input-group-text" type="submit" value="Upload">
                            </div>
                        </div>
                    </div>     
                </form>               
            </div>
            <div class="col-md-3">
                <a href="/import-samples/subjects.csv" download="subjects.csv" class="btn btn-warning">Sample CSV</a>
            </div>
        </div>
        
        <div class="vr"></div>
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Import Teacher</h4>
            </div>
            <div class="col-md-5">
                <form method="post" action="{{ route('import.parse', ['name' => 'teacher']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="csvFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="input-group-text" type="submit" value="Upload">
                            </div>
                        </div>
                    </div>     
                </form>               
            </div>
            <div class="col-md-3">
                <a href="/import-samples/teachers.csv" download="teachers.csv" class="btn btn-warning">Sample CSV</a>
            </div>
        </div>
        
        <div class="vr"></div>
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <h5 class="m-0">Import Students</h4>
            </div>
            <div class="col-md-5">
                <form method="post" action="{{ route('import.parse', ['name' => 'student']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group m-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="csvFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="input-group-text" type="submit" value="Upload">
                            </div>
                        </div>
                    </div>     
                </form>               
            </div>
            <div class="col-md-3">
                <a href="/import-samples/students.csv" download="students.csv" class="btn btn-warning">Sample CSV</a>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
  </div>
@endsection