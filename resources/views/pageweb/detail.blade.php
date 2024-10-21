@extends('template-web.layout')
@section('style')
    <style>
        .uniform-size {
            width: 100%;
            height: auto;
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
        }

        .index-size {
            width: 100%;
            max-width: 300px;
            height: 300px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-content position-relative">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4 border-end">
                        <img id="mainImage" src="{{ asset($barang->gambar[0]) }}" class="img-fluid index-size"
                            alt="Product Image">
                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                            @foreach ($barang->gambar as $index => $gambar)
                                <div class="col">
                                    <img src="{{ asset($gambar) }}"
                                        class="border rounded cursor-pointer uniform-size thumbnail-img"
                                        alt="Product Thumbnail" data-index="{{ $index }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $barang->nama }}</h4>
                            <div class="d-flex gap-3 py-3">
                                <div class="text-success"><i class='bx bx-package align-middle'></i> {{ $barang->stok }} Pcs</div>
                            </div>
                            <div class="mb-3">
                                <span class="price h4">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                            </div>

                            <hr>
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                <form action="{{ route('cart.add', $barang->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group input-spinner">
                                        <input type="number" id="quantity" name="quantity" class="form-control"
                                            value="1" min="1">
                                    </div>

                                    @foreach ($barang->opsi_barang as $opsi)
                                        <label class="form-label">Select {{ $opsi['opsi'] }}</label>
                                        <div>
                                            @foreach ($opsi['subopsi'] as $subopsi)
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="opsi_barang[{{ $opsi['opsi'] }}]" value="{{ $subopsi }}" required>
                                                    <div class="form-check-label">{{ $subopsi }}</div>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    <div class="d-flex gap-3 mt-3">
                                        <button type="submit" class="btn btn-outline-primary">Add to cart <i class='bx bxs-cart-alt'></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i></div>
                                        <div class="tab-title">Product Description</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                <p>{{ $barang->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumbnail-img');
            const quantityInput = document.getElementById('quantity');
            const stok = {{ $barang->stok }};
            const hargaJual = {{ $barang->harga_jual }};
            let images = @json($barang->gambar);

            // Update total price on quantity change
            quantityInput.addEventListener('input', function() {
                let quantity = parseInt(quantityInput.value);
                if (isNaN(quantity) || quantity < 1) quantity = 1;
                if (quantity > stok) quantity = stok;
                quantityInput.value = quantity;
            });

            // Thumbnail click handling
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const clickedIndex = this.getAttribute('data-index');
                    [images[0], images[clickedIndex]] = [images[clickedIndex], images[0]];
                    mainImage.src = '{{ asset('') }}' + images[0];
                    thumbnails.forEach((thumb, index) => {
                        thumb.src = '{{ asset('') }}' + images[index];
                    });
                });
            });
        });
    </script>
@endsection
