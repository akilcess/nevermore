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
                <div class="parent-icon"><i class='bx bx-closet'></i></div>
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
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <circle cx="10.5" cy="19.5" r="1.5"></circle>
                        <circle cx="17.5" cy="19.5" r="1.5"></circle>
                        <path d="m14 13.99 4-5h-3v-4h-2v4h-3l4 5z"></path>
                        <path
                            d="M17.31 15h-6.64L6.18 4.23A2 2 0 0 0 4.33 3H2v2h2.33l4.75 11.38A1 1 0 0 0 10 17h8a1 1 0 0 0 .93-.64L21.76 9h-2.14z">
                        </path>
                    </svg>
                </div>
                <div class="menu-title">PROSES PESANAN</div>
            </a>
            <ul>
                <li>
                    <a href="/proses-pesanan"><i class="bx bx-right-arrow-alt"></i>PESANAN MASUK
                        <span class="alert-count">
                            {{ Auth::check() ? \App\Models\Checkout::where('status', 'pending')->count() : 0 }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/pesanan-dikirim"><i class="bx bx-right-arrow-alt"></i>PESANAN DIKIRIM
                        <span class="alert-count">
                            {{ Auth::check() ? \App\Models\Checkout::where('status', 'dikirim')->count() : 0 }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/pesanan-selesai"><i class="bx bx-right-arrow-alt"></i>PESANAN SELESAI
                        <span class="alert-count">
                            {{ Auth::check() ? \App\Models\Checkout::where('status', 'selesai')->count() : 0 }}
                        </span>
                    </a>
                </li>
                
            </ul>
        </li>
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
