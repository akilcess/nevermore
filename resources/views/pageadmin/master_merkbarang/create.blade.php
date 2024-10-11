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
                            <li class="breadcrumb-item active" aria-current="page">Master Merk Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Tambah Master Merk Barang</h5>
                            </div>
                            <hr>
                            <form action="{{ route('merk.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama Merk Barang</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                                </div>
                                <!-- Deskripsi -->
                                <div class="col-md-12">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                                </div>
                                <!-- logo -->
                                <div class="col-md-12 mb-4">
                                    <label for="logo" class="form-label">Logo Merk</label>
                                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                                    <small class="form-text text-muted">Format gambar yang diizinkan: jpeg, png, jpg, gif.</small>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
