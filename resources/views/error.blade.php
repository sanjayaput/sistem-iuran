@extends('layouts.app')

@section('title')
   {{ session()->get('status') }}
@endsection
@section('content')

<div class="content d-flex justify-content-center align-items-center">
   <!-- Container -->
   <div class="flex-fill">
      <!-- Error title -->
      <div class="text-center mb-3">
         <h1 class="error-title">{{ session()->get('status') }}</h1>
         <h5>{{ session()->get('message') }}</h5>
      </div>
      <!-- /error title -->
      <!-- Error content -->
      <div class="row">
         <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">
            <!-- Buttons -->
            <div class="row">
                  <a href="{{ URL::to('home') }}" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i> Beranda</a>
            </div>
            <!-- /buttons -->
         </div>
      </div>
      <!-- /error wrapper -->
   </div>
   <!-- /container -->
</div>
@endsection