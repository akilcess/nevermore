@extends('template-web.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content position-relative">
            <div class="col-12 mb-3">
                <h3>{{ $jenisBarang->nama }}</h3>

            </div>
            <hr>
            <div class="row row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                @foreach ($barangs as $index => $barang)
                    <div class="col">
                        <!-- Wrap the entire card inside an <a> tag -->
                        <a href="{{ route('produk.detail', $barang->id) }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <!-- Display only the first image in the gambar array -->
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
