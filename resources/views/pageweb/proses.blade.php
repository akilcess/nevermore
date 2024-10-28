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
                                            <div class="text-muted" id="rekening-number">5181-0102-1420-531</div>
                                        </div>
                                        <button class="btn btn-outline-secondary" onclick="copyRekening()">Salin</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between border p-3 rounded mt-2">
                                        <img src="data:image/png;base64,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"
                                            alt="Bank BRI logo" width="40" height="40">
                                        <div class="flex-grow-1 ms-3">
                                            <div class="text-muted" id="rekening-number-bca">7920700939</div>
                                        </div>
                                        <button class="btn btn-outline-secondary" onclick="copyRekeningBca()">Salin</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center border p-3 rounded mt-2">
                                        <img src="{{ asset('env') }}/qris.jpg"
                                            alt="Bank BRI logo" width="150" height="auto">
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
        function copyRekeningBca() {
            const rekening = document.getElementById('rekening-number-bca').textContent;
            navigator.clipboard.writeText(rekening).then(() => {
                alert('Nomor rekening disalin');
            });
        }
    </script>
@endsection
