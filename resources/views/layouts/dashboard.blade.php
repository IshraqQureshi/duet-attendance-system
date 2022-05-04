@include('layouts.includes.head')

<div class="wrapper">

    @include('layouts.includes.nav')
    @include('layouts.includes.sidebar')
 
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $pageTitle }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            @yield('pageContent')
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  
    @include('layouts.includes.footer')

</div>

<div class="waitAlertOverlay"></div>
<div class="waitAlert">
  <h4>Please Wait...</h4>
</div>
<!-- ./wrapper -->
@include('layouts.includes.foot')