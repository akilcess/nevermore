@extends('template-web.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content position-relative">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Quantity</th>
                                    <th>Harga Total</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keranjangItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-start mb-3">
                                                <img src="{{ asset($item->barang->gambar[0]) }}" alt="Product Image" class="me-3 rounded" style="width: 70px; height: 70px;">
                                                <div>
                                                    <h6 class="card-text">{{ $item->barang->nama }}</h6>
                                                    <p class="d-block">
                                                        @if (is_array($item->opsi_barang))
                                                            @foreach($item->opsi_barang as $key => $value)
                                                                {{ $key }}: {{ $value }}<br>
                                                            @endforeach
                                                        @else
                                                            {{ $item->opsi_barang }}  <!-- Fallback for non-array cases -->
                                                        @endif
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item->barang->harga_jual, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="col-md-6">
                                                <h6 class="card-text">{{ $item->quantity }}</h6>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex order-actions align-items-center">
                                                <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="delete-form me-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger"><i class='bx bxs-trash'></i></button>
                                                </form>
                                        
                                                <a href="{{ route('produk.detail', $item->barang->id) }}" class="btn btn-link text-success">
                                                    <i class='bx bxs-edit-alt'></i>
                                                </a>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Keranjang Anda kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                        @if ($keranjangItems->count() > 0)
                            <div class="col mt-4">
                                <a href="{{ route('proses.checkout') }}" class="btn btn-outline-success px-5">
                                    <i class='bx bxs-cart-download me-2'></i> Checkout
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection