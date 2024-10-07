<ul class="metismenu" id="menu">
    @if (Auth::user()->role == 'admin')
        <li class="menu-label">DASHBOARD</li>
        <li>
            <a href="/dashboard-owner">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">DASHBOARD</div>
            </a>
        </li>
    @elseif(Auth::user()->role == 'pegawai')
        <li class="menu-label">DASHBOARD</li>
        <li>
            <a href="/dashboard-pegawai">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">DASHBOARD</div>
            </a>
        </li>
    @endif

    @if (Auth::user()->role == 'admin')
        <li class="menu-label">MASTER DATA</li>
        <li>
            <a href="/master-pegawai">
                <div class="parent-icon"><i class='bx bx-male'></i></div>
                <div class="menu-title">PEGAWAI</div>
            </a>
        </li>
    @endif

    @if (Auth::user()->role == 'pegawai')
        <li class="menu-label">PEGAWAI PAGE</li>
        <li>
            <a href="/">
                <div class="parent-icon"><i class='bx bxs-book-open'></i></div>
                <div class="menu-title"></div>
            </a>
        </li>
    @endif

</ul>
