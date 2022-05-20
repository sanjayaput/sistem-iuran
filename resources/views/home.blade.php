@extends('layouts.app')
@section('title')
    Home
@endsection

@section('content')

<!-- Widget -->
<div class="row">
<div class="content">

<!-- Inner container -->
<div class="d-md-flex align-items-md-start">
    <!-- Right content -->
    <div class="tab-content w-100 overflow-auto">
        <div class="tab-pane fade active show" id="profile">

            <!-- Sales stats -->
            <div class="card">
                <div class="card-body @if(!$profil_desa) text-center @endif">
                    @if ($profil_desa)
                        {!! $profil_desa->konten !!}
                    @else
                        <img src="{{ asset('logo_asak.png') }}" width="200" height="200" class="rounded-circle" alt="" />
                            
                            <h4 class="font-weight-semibold mb-1">SELAMAT DATANG</h4>
                            <h5 class="card-title mb-4">DI SISTEM INFORMASI PENGELOLAAN KEUANGAN DESA ADAT ASAK</h5>
                        </div>
                    @endif
            </div>
            <!-- /sales stats -->

        </div>
    </div>
    <!-- /right content -->

</div>
<!-- /inner container -->

</div>
</div>

@endsection

