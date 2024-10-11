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
                        <form action="{{ route('request_stok.update', $requestStok->id) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')

                            <div class="col-md-12">
                                <label for="barang_id" class="form-label">Nama Barang</label>
                                <select class="form-control" id="barang_id" name="barang_id" required>
                                    <option value="">Pilih Nama Barang</option>
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->id }}" {{ $requestStok->barang_id == $b->id ? 'selected' : '' }}>
                                            {{ $b->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                             <!-- stok awal -->
                             <div class="col-md-6">
                                <label for="stok_awal" class="form-label">Stok Awal</label>
                                <input type="number" class="form-control" id="stok_awal" name="stok_awal" value="{{ $requestStok->stok_awal }}" readonly required>
                            </div>
                             <!-- permintaan stok -->
                             <div class="col-md-6">
                                <label for="request_stok" class="form-label">Permintaan Stok</label>
                                <input type="number" class="form-control" id="request_stok" name="request_stok" value="{{ $requestStok->request_stok }}" required>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // When the user selects a barang
    $('#barang_id').change(function() {
        var barangId = $(this).val();
        if (barangId) {
            $.ajax({
                url: '/get-stok/' + barangId,
                type: 'GET',
                success: function(response) {
                    // Set the value of the stok_awal input field
                    $('#stok_awal').val(response.stok);
                }
            });
        } else {
            $('#stok_awal').val('');
        }
    });
</script>
@endsection
