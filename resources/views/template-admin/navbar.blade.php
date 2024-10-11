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
        <li>
            <a href="/master-jenisbarang">
                <div class="parent-icon"><i class='bx bxs-purchase-tag'></i></div>
                <div class="menu-title">JENIS BARANG</div>
            </a>
        </li>
        <li>
            <a href="/master-merkbarang">
                <div class="parent-icon"><i class='bx bxs-purchase-tag-alt'></i></div>
                <div class="menu-title">MERK BARANG</div>
            </a>
        </li>
        <li>
            <a href="/master-barang">
                <div class="parent-icon"><i class='bx bx-closet' ></i></div>
                <div class="menu-title">BARANG</div>
            </a>
        </li>
        <li>
            <a href="/konfirm-request-stok">
                <div class="parent-icon"><i class='bx bx-git-pull-request'></i></div>
                <div class="menu-title">KONFIRMASI STOK</div>
            </a>
        </li>
    @endif

    @if (Auth::user()->role == 'pegawai')
        <li class="menu-label">PEGAWAI PAGE</li>
        <li>
            <a href="/manage-gambar">
                <div class="parent-icon"><i class='bx bxs-file-image'></i></div>
                <div class="menu-title">MANAGE GAMBAR</div>
            </a>
        </li>
        <li>
            <a href="/request-stok">
                <div class="parent-icon"><i class='bx bxs-package'></i></div>
                <div class="menu-title">REQUEST STOK</div>
            </a>
        </li>
    @endif

</ul>
