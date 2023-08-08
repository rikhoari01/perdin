<section class="menu">
    <div class="logo">
        <img src="{{ asset('img/Logo.png') }}" alt="logo">
    </div>
    <div class="menu-content">
        <div>
            <div class="menu-title">Dashboard <span class="role">{{ ucfirst(Auth::user()->role) }}</span></div>
        <ul class="menu-item">
            @if(Auth::user()->role == 'admin')
                <li class="active">
                    <a href="/dasboard">
                        <div class="menu-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <span class="menu-text">
                            Kelola Pengguna
                        </span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role == 'sdm')
                <li class="{{ (request()->is('dashboard', 'history')) ? 'active' : '' }}">
                    <a href="/dashboard">
                        <div class="menu-icon">
                            <i class="fa fa-layer-group"></i>
                        </div>
                        <span class="menu-text">
                            Pengajuan Perdin
                        </span>
                    </a>
                </li>
                <li class="{{ (request()->is('master-city')) ? 'active' : '' }}">
                    <a href="/master-city">
                        <div class="menu-icon">
                            <i class="fa fa-earth"></i>
                        </div>
                        <span class="menu-text">
                            Master Kota
                        </span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role == 'pegawai')
                <li class="active">
                    <a href="/dashboard">
                        <div class="menu-icon">
                            <i class="fa fa-layer-group"></i>
                        </div>
                        <span class="menu-text">
                            Perdinku
                        </span>
                    </a>
                </li>
            @endif
        </ul>
        </div>

        <div class="menu-logout">
            <a href="{{ route('logout') }}" class="logout">
                <div class="menu-icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <span class="menu-text">
                    Log Out
                </span>
            </a>
        </div>
    </div>
</section>