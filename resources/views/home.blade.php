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
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('logo_asak.png') }}" width="200" height="200" class="rounded-circle" alt="" />
                            <h4 class="font-weight-semibold mb-1">SELAMAT DATANG</h4>
                            <h5 class="card-title mb-4">DI SISTEM INFORMASI PENGELOLAAN KEUANGAN DESA ADAT ASAK</h5>
                        </div>
                        @if ($profil_desa)
                            <h1 class="text-center">Profil Desa</h1>
                            {!! $profil_desa->konten !!}
                        @endif
                    </div>
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

