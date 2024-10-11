@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Request Stok</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-7 mx-auto">
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Edit Request Stok</h5>
                        </div>
                        <hr>
                        <form action="{{ route('konfirm_request_stok.update', $requestStok->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">

                            <!-- Display Barang details -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="barang_nama">Nama Barang</label>
                                    <input type="text" class="form-control" id="barang_nama" name="barang_nama" value="{{ $requestStok->barang->nama }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="jenis_barang">Jenis Barang</label>
                                    <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="{{ $requestStok->barang->jenisBarang->nama ?? 'N/A' }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="merk_barang">Merk Barang</label>
                                    <input type="text" class="form-control" id="merk_barang" name="merk_barang" value="{{ $requestStok->barang->merkBarang->nama ?? 'N/A' }}" readonly>
                                </div>
                            </div>
                            
                            <!-- Display Stok Awal -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="stok_awal">Stok Saat Ini</label>
                                    <input type="number" class="form-control" id="stok_awal" name="stok_awal" value="{{ $requestStok->barang->stok }}" readonly>
                                </div>
                            </div>

                            <!-- Display Request Stok -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="request_stok">Permintaan Stok</label>
                                    <input type="number" class="form-control" id="request_stok" name="request_stok" value="{{ $requestStok->request_stok }}" readonly>
                                </div>
                            </div>

                            <!-- Status selection -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="belum dikonfirmasi" {{ $requestStok->status == 'belum dikonfirmasi' ? 'selected' : '' }}>Belum Dikonfirmasi</option>
                                        <option value="dikonfirmasi" {{ $requestStok->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                        <option value="tidak diproduksi lagi" {{ $requestStok->status == 'tidak diproduksi lagi' ? 'selected' : '' }}>Tidak Diproduksi Lagi</option>
                                        <option value="ditolak" {{ $requestStok->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </div>
                            </div>
                        </form>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
