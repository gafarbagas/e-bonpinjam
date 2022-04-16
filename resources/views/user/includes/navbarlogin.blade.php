<nav class="navbar navbar-expand-lg bg-sidebar navbar-dark fixed-top">
    <div class="container">
        
        <a class="navbar-brand" href="/e-bonpinjam"><img src="{{url('img/logokejaksaan.png')}}" style="width: 35px"> E-BonPinjam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{Request::is('e-bonpinjam')?' active':''}}">
                    <a class="nav-link" href="{{'/e-bonpinjam'}}">
                        Login
                    </a>
                </li>
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-lg-inline">
                        <a class="nav-link">
                            <div class="navbar-divider"></div>
                        </a>
                    </li>
                </ul>
                <li class="nav-item {{Request::is('e-bonpinjam/lacak')?' active':''}}">
                    <a class="nav-link" href="{{'/e-bonpinjam/lacak'}}">
                        <i class="fas fa-search fa-sm fa-fw"></i>
                        Lacak Pengajuan Peminjaman
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>