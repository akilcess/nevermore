@extends('template-web.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content position-relative">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Pesanan Saya</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-success  justify-content-center" role="tablist">
                            {{-- JIKA STATUS PENDING --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#dikemas" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon">
                                        </div>
                                        <div class="tab-title">Dikemas</div>
                                    </div>
                                </a>
                            </li>
                            {{-- JIKA STATUS DIKIRIM --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#dikirim" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon">
                                        </div>
                                        <div class="tab-title">Dikirim</div>
                                    </div>
                                </a>
                            </li>
                            {{-- JIKA STATUS SELESAI --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#selesai" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon">
                                        </div>
                                        <div class="tab-title">Selesai</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="dikemas" role="tabpanel">
                                @foreach ($checkoutData as $checkout)
                                    @if ($checkout['status'] == 'pending')
                                        {{-- Adjust this condition based on your status logic --}}
                                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-body">
                                                        @foreach ($checkout['items'] as $item)
                                                            <div class="d-flex align-items-start mb-3">
                                                                <img src="{{ asset($item['gambar_barang']) }}"
                                                                    alt="Bukti Pembayaran" class="me-3 rounded"
                                                                    style="width: 70px; height: 70px;">
                                                                <div>
                                                                    <h6 class="card-text">{{ $item['nama_barang'] }}</h6>
                                                                    <p class="d-block">
                                                                        <!-- Display opsi_barang (Ukuran, Warna) -->
                                                                        @foreach ($item['opsi_barang'] as $key => $value)
                                                                        {{ $key }}: {{ $value }}<br>
                                                                        @endforeach
                                                                    </p>
                                                                    <p class="card-text">Jumlah : {{ $item['quantity'] }}</p>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="d-flex align-items-start mb-3">
                                                            <div>
                                                                <p class="d-block">
                                                                    Total Harga:
                                                                    Rp{{ number_format($checkout['total_harga'], 0, ',', '.') }}
                                                                </p>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="dikirim" role="tabpanel">
                                @foreach ($checkoutData as $checkout)
                                    @if ($checkout['status'] == 'dikirim')
                                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-body">
                                                        @foreach ($checkout['items'] as $item)
                                                            <div class="d-flex align-items-start mb-3">
                                                                <img src="{{ asset($item['gambar_barang']) }}"
                                                                    alt="Bukti Pembayaran" class="me-3 rounded"
                                                                    style="width: 70px; height: 70px;">
                                                                <div>
                                                                    <h6 class="card-text">{{ $item['nama_barang'] }}</h6>
                                                                    <p class="d-block">
                                                                        @foreach ($item['opsi_barang'] as $key => $value)
                                                                            {{ $key }}: {{ $value }}<br>
                                                                        @endforeach
                                                                    </p>
                                                                    <p class="card-text">Jumlah : {{ $item['quantity'] }}</p>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="d-flex align-items-start mb-3">
                                                            <div>
                                                                <p class="d-block">
                                                                    Total Harga:
                                                                    Rp{{ number_format($checkout['total_harga'], 0, ',', '.') }}
                                                                </p>
                                                                <hr>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="d-flex align-items-start mb-3">
                                                            <div>
                                                                <p class="d-block text-success">
                                                                    NO RESI:
                                                                    {{ $checkout['no_resi'] }}
                                                                </p>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('pesanan.selesai', $checkout['id']) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-dark px-5">Pesanan
                                                                Selesai</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="selesai" role="tabpanel">
                                @foreach ($checkoutData as $checkout)
                                    @if ($checkout['status'] == 'selesai')
                                        {{-- Adjust this condition based on your status logic --}}
                                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1">
                                            <div class="col">
                                                <div class="card">
                                                    <div class="card-body">
                                                        @foreach ($checkout['items'] as $item)
                                                            <div class="d-flex align-items-start mb-3">
                                                                <img src="{{ asset($item['gambar_barang']) }}"
                                                                    alt="Bukti Pembayaran" class="me-3 rounded"
                                                                    style="width: 70px; height: 70px;">
                                                                <div>
                                                                    <h6 class="card-text">{{ $item['nama_barang'] }}</h6>
                                                                    <p class="d-block">
                                                                        <!-- Display opsi_barang (Ukuran, Warna) -->
                                                                        @foreach ($item['opsi_barang'] as $key => $value)
                                                                            {{ $key }}: {{ $value }}<br>
                                                                        @endforeach
                                                                    </p>
                                                                    <p class="card-text">Jumlah : {{ $item['quantity'] }}</p>

                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="d-flex align-items-start mb-3">
                                                            <div>
                                                                <p class="d-block">
                                                                    Total Harga:
                                                                    Rp{{ number_format($checkout['total_harga'], 0, ',', '.') }}
                                                                </p>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
