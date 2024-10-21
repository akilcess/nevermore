@php
    use App\Models\JenisBarang;
    use App\Models\MerkBarang;
    $jenis = JenisBarang::all();
    $merk = MerkBarang::all();
@endphp

<div class="nav-container primary-menu">
    <div class="mobile-topbar-header">
        <div>
            <h4 class="logo-text text-dark">E-Shop</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
    </div>
    <nav class="navbar navbar-expand-xl w-100">
        <div class="container">
            <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">

                <li class="nav-item dropdown">
                    <a href="/" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                        <div class="parent-icon"></div>
                        <div class="menu-title">Home</div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="/semua-produk" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                        <div class="parent-icon"></div>
                        <div class="menu-title">Semua Produk</div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                        data-bs-toggle="dropdown">
                        <div class="parent-icon"></div>
                        <div class="menu-title">Jenis Produk</div>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($jenis as $index => $p)
                            <li>
                                <a class="dropdown-item" href="{{ route('produk.jenis', $p->id) }}"><i
                                        class="bx bx-right-arrow-alt"></i>{{ $p->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                        data-bs-toggle="dropdown">
                        <div class="parent-icon"></div>
                        <div class="menu-title">Merk Produk</div>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($merk as $index => $p)
                            <li>
                                <div class="d-flex align-items-start ">
                                    <div>
                                        <a class="dropdown-item d-block" href="{{ route('produk.merk', $p->id) }}"><img
                                                src="{{ asset($p->logo) }}" alt="Image 1" class="me-3 rounded"
                                                style="width: 30px; height: 30px;"></i>{{ $p->nama }}</a>
                                        <hr>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
