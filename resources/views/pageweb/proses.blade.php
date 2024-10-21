@extends('template-web.layout')

@section('content')
    <!-- Error Messages -->

    <div class="page-wrapper">
        <div class="page-content position-relative">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <div class="h4 fw-bold">Alamat</div>
                            <div class="border p-3 rounded">
                                <p><strong>{{ $profileUser->nama }}</strong></p>
                                <p>{{ $profileUser->telepon }}</p>
                                <p>{{ $city->city_name }}, {{ $province->province }}, {{ $profileUser->alamat }}</p>
                            </div>
                        </div>
                        <div>
                            <div class="h4 fw-bold">Pengiriman</div>
                            <div class="border p-3 rounded">
                                <div class="container mt-4">
                                    <div class="d-flex align-items-center justify-content-between border p-3 rounded">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/92/New_Logo_JNE.png"
                                            alt="JNE logo" width="100" height="40" class="rounded">
                                        <div class="flex-grow-1 ms-3">
                                            <div>
                                                <span class="fw-bold">JNE REG</span>
                                            </div>
                                            <div class="text-muted">2 - 3 days · Layanan reguler</div>
                                        </div>
                                        <div class="text-muted">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="h4 fw-bold">Order</div>
                        <div class="border p-3 rounded">
                            @foreach ($keranjangItems as $item)
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset($item->barang->gambar[0]) }}" alt="Product Image"
                                        class="me-3 rounded" style="width: 70px; height: 70px;""
                                        alt="Casual Kimono Wanita blue" class="me-3">
                                    <div>
                                        <div>{{ $item->barang->nama }}</div>
                                        <div>
                                            @if (is_array($item->opsi_barang))
                                                @foreach ($item->opsi_barang as $key => $value)
                                                    {{ $key }}: {{ $value }}<br>
                                                @endforeach
                                            @else
                                                {{ $item->opsi_barang }} <!-- Fallback for non-array cases -->
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ms-auto">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                </div>
                            @endforeach

                            <div>

                                <div class="d-flex justify-content-between">
                                    <div>Ongkos Kirim (REG)</div>
                                    @if ($reg_cost)
                                        <div>Rp {{ number_format($reg_cost, 0, ',', '.') }}</div>
                                    @else
                                        <p>Ongkos kirim tidak tersedia untuk layanan REG.</p>
                                    @endif
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <div>Total</div>
                                    <div>Rp {{ number_format($totalHarga, 0, ',', '.') }}</div>
                                </div>

                                <hr>
                                <div class="fw-bold">
                                    <div>Transfer Sesuai Total Ke Rekening berikut :</div>
                                    <div class="d-flex align-items-center justify-content-between border p-3 rounded mt-2">
                                        <img src="https://seeklogo.com/images/B/bank-bri-logo-32EFAA879E-seeklogo.com.png"
                                            alt="Bank BRI logo" width="40" height="40">
                                        <div class="flex-grow-1 ms-3">
                                            <div class="text-muted" id="rekening-number">21231313145</div>
                                        </div>
                                        <button class="btn btn-outline-secondary" onclick="copyRekening()">Salin</button>
                                    </div>
                                </div>




                            </div>
                        </div>
                        <div class="col mt-3">
                            <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Sembunyikan total harga dengan input hidden -->
                                <input type="hidden" id="total_harga" name="total_harga" value="{{ $totalHarga }}" required>
                        
                                <div class="fw-bold mt-2">
                                    <div>Upload Bukti Transfer</div>
                                    <div class="d-flex align-items-center justify-content-between border p-3 rounded mt-2">
                                        <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success px-5">Selesaikan Pembayaran</button>
                            </form>
                        </div>
                        

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
    <script>
        function copyRekening() {
            const rekening = document.getElementById('rekening-number').textContent;
            navigator.clipboard.writeText(rekening).then(() => {
                alert('Nomor rekening disalin');
            });
        }
    </script>
@endsection
