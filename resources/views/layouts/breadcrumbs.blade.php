<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i> <span class="font-weight-semibold text-uppercase">@yield('title')</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements">
            <a href="{{ url()->previous() }}" class="btn bg-slate btn-labeled btn-labeled-left" type="button">
                <b><i class="icon-arrow-left8"></i></b> Kembali
            </a>
        </div>
    </div>

    <!-- <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home mr-2"></i> Home</a>
                <a href="#" class="breadcrumb-item">Link</a>
                <span class="breadcrumb-item active">Current</span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div> -->
</div>
<!-- /page header -->
