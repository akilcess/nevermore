@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Penjualan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">PESANAN DITERIMA</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Pesanan</th>
                                    <th>Total Harga</th>
                                    <th>Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkoutData as $checkout)
                                    @if ($checkout['status'] == 'dikirim')
                                        <tr>
                                            <td>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Barang</th>
                                                            <th>Opsi Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Detail Customer</th>
                                                            <th>Gambar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($checkout['items'] as $item)
                                                            <tr>
                                                                <td>{{ $item['nama_barang'] }}</td>
                                                                <td>
                                                                    <p class="d-block">
                                                                        @foreach ($item['opsi_barang'] as $key => $value)
                                                                            {{ $key }}: {{ $value }}<br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td class="card-text">{{ $item['quantity'] }}</td>
                                                                <td>
                                                                    @if ($checkout['user_details'])
                                                                        Nama: {{ $checkout['user_details']['nama'] }}<br>
                                                                        Alamat: {{ $checkout['user_details']['city'] ?? 'Unknown' }}, {{ $checkout['user_details']['province'] ?? 'Unknown' }}, {{ $checkout['user_details']['alamat'] }}<br>
                                                                        Telepon: {{ $checkout['user_details']['telepon'] }}<br>
                                                                       
                                                                    @else
                                                                        <p>User details not available.</p>
                                                                    @endif
                                                                </td>
                                                                
                                                                
                                                                <td class="card-text"><img
                                                                        src="{{ asset($item['gambar_barang']) }}"
                                                                        width="100px" alt="" srcset="">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td> Rp{{ number_format($checkout['total_harga'], 0, ',', '.') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#buktiModal{{ $checkout['id'] }}">
                                                    Lihat Bukti Pembayaran
                                                </button>
                                            </td>
                                           
                                        </tr>


                                        <!-- Modal for Payment Proof -->
                                        <div class="modal fade" id="buktiModal{{ $checkout['id'] }}" tabindex="-1"
                                            aria-labelledby="buktiModalLabel{{ $checkout['id'] }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col mb-3">
                                                                <div class="card">
                                                                    <img src="{{ asset($checkout['bukti_pembayaran']) }}"
                                                                        alt="Bukti Pembayaran" class="img-fluid"
                                                                        style="width: 100%; height: auto;">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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
