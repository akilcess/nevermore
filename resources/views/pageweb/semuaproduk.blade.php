@extends('template-web.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content position-relative">
            <div class="col-12 mb-3">
                <h3>Semua Produk</h3>
            </div>

            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('semua.produk') }}" method="GET">
                    <div class="flex-grow-1">
                        <div class="position-relative search-bar-box">
                            <!-- Penutupan kutipan di value ditambahkan dan form-control diperbaiki -->
                            <input type="text" name="search" class="form-control search-control" placeholder="Cari produk, jenis, atau merk..." value="{{ request('search') }}">
                            
                            <!-- Ikon pencarian -->
                            <span class="position-absolute top-50 search-show translate-middle-y">
                                <i class='bx bx-search'></i>
                            </span>
                            
                         
                        </div>
                    </div>
                </form>
                
            </div>

            <hr>

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
