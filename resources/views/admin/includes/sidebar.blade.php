<ul class="navbar-nav bg-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url ('/e-bonpinjam/admin')}}">
        <div class="sidebar-brand-icon">
            <img src="{{url('img/logokejaksaan.png')}}" style="width: 40px">
        </div>
        <div class="sidebar-brand-text mx-2">E-BONPINJAM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Request::is('e-bonpinjam/admin')?' active bg-hover':''}}">
        <a class="nav-link" href="{{url ('/e-bonpinjam/admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    @if (auth()->user()->role_id == 2)

        <li class="nav-item {{Request::is('e-bonpinjam/admin/datamaster*')?'active bg-hover':''}}">
            <a class="nav-link" href="{{url ('/e-bonpinjam/admin/datamaster')}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Master</span>
            </a>
        </li>

        <li class="nav-item {{Request::is('e-bonpinjam/admin/pengguna*')?'active bg-hover':''}}">
            <a class="nav-link" href="{{url ('/e-bonpinjam/admin/pengguna')}}">
                <i class="fas fa-fw fa-user"></i>
                <span>Pengguna</span>
            </a>
        </li>

    @endif

    <li class="nav-item {{Request::is('e-bonpinjam/admin/jaksa*')?'active bg-hover':''}}">
        <a class="nav-link" href="{{url ('/e-bonpinjam/admin/jaksa')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Jaksa</span>
        </a>
    </li>
    
    <li class="nav-item {{Request::is('e-bonpinjam/admin/terdakwa*')?'active bg-hover':''}}">
        <a class="nav-link" href="{{url ('/e-bonpinjam/admin/terdakwa')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Terdakwa</span></a>
    </li>
    
    <li class="nav-item {{Request::is('e-bonpinjam/admin/barangbukti*')?'active bg-hover':''}}">
        <a class="nav-link" href="{{url ('/e-bonpinjam/admin/barangbukti')}}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Barang Bukti</span></a>
    </li>

    <li class="nav-item {{Request::is('e-bonpinjam/admin/peminjaman*')?'active bg-hover':''}}">
        <a class="nav-link" href="{{url('/e-bonpinjam/admin/peminjaman')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Peminjaman Barang Bukti</span></a>
    </li>

    @if (auth()->user()->role_id != 3)

        <li class="nav-item {{Request::is('e-bonpinjam/admin/laporan*')?'active bg-hover':''}}">
            <a class="nav-link" href="{{url ('/e-bonpinjam/admin/laporan')}}">
                <i class="fas fa-fw fa-print"></i>
                <span>Laporan</span>
            </a>
        </li>

    @endif



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>