<nav class="navbar navbar-expand-lg bg-sidebar navbar-dark fixed-top">
    <div class="container">
        
        <a class="navbar-brand" href="/e-bonpinjam/user"><img src="{{url('img/logokejaksaan.png')}}" style="width: 35px"> E-BonPinjam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{Request::is('e-bonpinjam/user')?' active':''}}">
                    <a class="nav-link" href="{{'/e-bonpinjam/user'}}">Beranda
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>Pengaturan</span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item"href="{{'/e-bonpinjam/user/profil'}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profil
                        </a>
                        <a class="dropdown-item" href="{{'/e-bonpinjam/user/ubahpassword'}}">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ubah Password
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item d-none d-lg-inline align-items-center">
                    <a class="nav-link active">
                        <span class="">Hi, {{$user->nama_masyarakat}}</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item d-none d-lg-inline align-items-center">
                    <a class="nav-link">
                        <img class="img-profile rounded-circle" src="/img/profile/{{$user->avatar}}" style="width: 35px; height:35px">
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item d-none d-lg-inline">
                    <a class="nav-link">
                        <div class="navbar-divider"></div>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        Logout
                        <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Logout" apabila telah yakin menyelesaikan tugas.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="/e-bonpinjam/logout">Keluar</a>
            </div>
        </div>
    </div>
</div>