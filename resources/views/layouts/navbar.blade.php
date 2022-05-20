<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-md fixed-top">
    <div class="navbar-brand">
        <!-- <a href="{{ url('/home') }}" class="d-inline-block"> -->
        <h6 class="mb-0">SISTEM INFORMASI PENGELOLAAN KEUANGAN DESA ADAT ASAK</h6>
        <!-- </a> -->
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
           

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    @role('admin')
                        <img src="{{ asset('admin.png') }}" class="rounded-circle" width="38" height="38" style="object-fit: contain" alt="" />
                    @endrole

                    @role('anggota')
                        <img src="{{ asset('warga.png') }}" class="rounded-circle" width="38" height="38" style="object-fit: contain" alt="" />
                    @endrole
                    
                    @role('kades')
                        <img src="{{ asset('desa.png') }}" class="rounded-circle" width="38" height="38" style="object-fit: contain" alt="" />
                    @endrole

                    <span>{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <!-- <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
                    <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-blue ml-auto">58</span></a>
                    <div class="dropdown-divider"></div> -->
                    <a href="{{ URL::to('users/edit') }}/{{ Auth::user()->id }}" class="dropdown-item"><i class="icon-user"></i> Profile</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="icon-switch2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->