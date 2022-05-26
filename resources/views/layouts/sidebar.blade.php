<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        @role('admin')
                            <a href="#"><img src="{{ asset('admin.png') }}" width="38" height="38" class="rounded-circle" style="object-fit:contain" alt="" /> </a>
                        @endrole
                        @role('anggota')
                            <a href="#"><img src="{{ asset('warga.png') }}" width="38" height="38" class="rounded-circle" style="object-fit:contain" alt="" /> </a>
                        @endrole
                        @role('kades')
                            <a href="#"><img src="{{ asset('desa.png') }}" width="38" height="38" class="rounded-circle" style="object-fit:contain" alt="" /> </a>
                        @endrole
                    </div>
                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }} 
                            @foreach(Auth::user()->roles->pluck('name') as $role)
                            <span class="pl-1">( {{ ucfirst(($role == 'kades' ? 'bendesa' : $role)) }} )</span>
                            @endforeach
                        </div>
                        <div class="font-size-xs opacity-50">{{ Auth::user()->username }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                    <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Home</span>
                    </a>
                </li>
            @if(Gate::check('pemasukan-list') || Gate::check('pengeluaran-list') || Gate::check('iuran-list'))
                <li class="nav-item nav-item-submenu  {{ (request()->is('pemasukan*') || request()->is('pengeluaran*') || request()->is('iuran*'))  ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-stack2"></i> <span>Transaksi</span></a>

                    <ul class="nav nav-group-sub" >
                    @if(Gate::check('pemasukan-list'))
                        <li class="nav-item"><a href="{{ URL::to('pemasukan') }}" class="nav-link {{ request()->is('pemasukan*') ? 'active' : '' }}">Pemasukan</a></li>
                    @endif
                    @if(Gate::check('pengeluaran-list'))
                        <li class="nav-item"><a href="{{ URL::to('pengeluaran') }}" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">Pengeluaran</a></li>
                    @endif
                    @if(Gate::check('iuran-list'))
                        <li class="nav-item"><a href="{{ URL::to('iuran') }}" class="nav-link {{ request()->is('iuran*') ? 'active' : '' }}">Iuran</a></li>
                    @endif
                    </ul>
                </li>
            @endif

            @if(Gate::check('grafik'))
                <li class="nav-item">
                    <a href="{{ url('/chart') }}" class="nav-link {{ request()->is('chart') ? 'active' : '' }}">
                        <i class="icon-stats-bars3"></i>
                        <span>Grafik Keuangan</span>
                    </a>
                </li>
            @endif

            @if(Gate::check('user-list'))
                <li class="nav-item">
                    <a href="{{ url('/users') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="icon-users"></i>
                        <span>User</span>
                    </a>
                </li>
            @endif

            @role('admin')
                <li class="nav-item">
                    <a href="{{ url('/profil-desa') }}" class="nav-link {{ request()->is('profil-desa') ? 'active' : '' }}">
                        <i class="icon-cogs"></i>
                        <span>Profil Desa</span>
                    </a>
                </li>
            @endrole

            <!-- @role('admin') -->
                <!-- Settings -->
                <!-- <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Setting</div>
                    <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item nav-item-submenu  {{ (request()->is('roles*')) ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-user-lock"></i> <span>Autentikasi</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                        <li class="nav-item"><a href="{{ URL::to('roles') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">Level</a></li>
                    </ul>
                </li> -->
            <!-- @endrole -->
                <!-- /main -->
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->
</div>
<!-- /main sidebar -->