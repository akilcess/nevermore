@extends('template-web.layout')

@section('content')
    <!-- JUMBOTRON -->
    <div class="jumbotron jumbotron-fluid position-relative" style="padding-top: 30px;">
        <picture>
            <source media="(max-width: 768px)"
                srcset="https://preloved.co.id/_ipx/w_1920,f_webp,q_80,fit_cover/images/banners/banner-girl-stack-mobile.jpg">
            <img src="https://preloved.co.id/_ipx/w_1920,f_webp,q_80,fit_cover/images/banners/banner-girl-stack.jpg"
                alt="Banner" class="img-fluid w-300 rounded-bottom" style="object-fit: cover;">
        </picture>

        <!-- Teks yang ditambahkan di dalam gambar -->
        <div class="position-absolute text-white text-center" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <h1 class="display-4">Welcome to E-Shop</h1>
            <p class="lead">Find the best deals here!</p>
        </div>
    </div>

    <!-- JUMBOTRON -->


    <div class="page-wrapper">
        <!-- CAROUSEL -->
        <div id="carouselExampleIndicators" class="carousel slide mb-2" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Nilai interval disini adalah 3000 milidetik (3 detik) -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active mr-3">
                    <div class="d-flex">
                        <img src="https://preloved.co.id/_ipx/w_500,f_webp,q_80,fit_cover/images/banners/banner-new.jpg"
                            class="d-block w-50 m-3 rounded" alt="Slide 2" style="max-height: 200px; object-fit: cover;">
                        <img src="https://preloved.co.id/_ipx/w_800,f_webp,q_80,fit_cover/images/banners/banner-sell.jpg"
                            class="d-block w-50 m-3 rounded" alt="Slide 2" style="max-height: 200px; object-fit: cover;">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex">
                        <img src="https://preloved.co.id/_ipx/w_500,f_webp,q_80,fit_cover/images/banners/banner-new.jpg"
                            class="d-block w-50 m-3 rounded" alt="Slide 2" style="max-height: 200px; object-fit: cover;">
                        <img src="https://preloved.co.id/_ipx/w_800,f_webp,q_80,fit_cover/images/banners/banner-sell.jpg"
                            class="d-block w-50 m-3 rounded" alt="Slide 2" style="max-height: 200px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- CAROUSEL -->




        <div class="page-content position-relative">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-outline-dark position-relative me-lg-5"> Produk Terbaru <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">New
                        <span class="visually-hidden">unread messages</span></span>
                </button>
            </div>
            <!-- Teks di sudut kanan: Hot Item -->
            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('landing.index') }}" method="GET">
                    <div class="flex-grow-1">
                        <div class="position-relative search-bar-box">
                            <!-- Penutupan kutipan di value ditambahkan dan form-control diperbaiki -->
                            <input type="text" name="search" class="form-control search-control"
                                placeholder="Cari produk, jenis, atau merk..." value="{{ request('search') }}">

                            <!-- Ikon pencarian -->
                            <span class="position-absolute top-50 search-show translate-middle-y">
                                <i class='bx bx-search'></i>
                            </span>

                           
                        </div>
                    </div>
                    
                </form>

            </div>

            <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                @foreach ($barangs as $index => $barang)
                    <div class="col">
                        <a href="{{ route('produk.detail', $barang->id) }}" class="text-decoration-none text-dark">
                            <div class="card">
                                @if (!empty($barang->gambar) && is_array($barang->gambar))
                                    <img src="{{ asset($barang->gambar[0]) }}" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title cursor-pointer">{{ $barang->nama }}</h6>
                                    <div class="clearfix">
                                        <p class="mb-0 float-end fw-bold"><span
                                                class="me-2 text-decoration-line-through text-secondary"></span><span>Rp
                                                {{ number_format($barang->harga_jual, 0, ',', '.') }}</span></p>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 fs-6">
                                        <p class="mb-0 ms-auto">{{ $barang->stok }} pcs</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
