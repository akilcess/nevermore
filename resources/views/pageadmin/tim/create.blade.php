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
                        <li class="breadcrumb-item active" aria-current="page">Master Tim</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--breadcrumb-->

        <div class="row">
            <div class="col-xl-7 mx-auto">
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Tambah Master Tim</h5>
                        </div>
                        <hr>
                        <form action="{{ route('tim.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="nama_tim" class="form-label">Nama Tim</label>
                                <input type="text" class="form-control" id="nama_tim" name="nama_tim" required>
                            </div>
                            <div class="col-12">
                                <label for="peran" class="form-label">Peran Tim</label>
                                <textarea class="form-control"  rows="5" id="peran" name="peran" required></textarea>
                            </div>
                            <div class="col-12">
                                <label for="tindakan" class="form-label">Tindakan Tim</label>
                                <textarea class="form-control"  rows="5" id="tindakan" name="tindakan" required></textarea>
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
