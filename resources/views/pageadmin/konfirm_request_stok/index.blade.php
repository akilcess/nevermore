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
                        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Request Stok</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--breadcrumb-->
        <h6 class="mb-0 text-uppercase">Data Konfirmasi Request Stok</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Stok Saat Ini</th>
                                <th>Permintaan Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requestStok as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->barang->nama }}</td>
                                <td>{{ $p->stok_awal }}</td>
                                <td>{{ $p->request_stok }}</td>
                                <td>
                                    @if ($p->status == 'belum dikonfirmasi')
                                        <span class="badge bg-warning text-dark">Belum Dikonfirmasi</span>
                                    @elseif ($p->status == 'dikonfirmasi')
                                        <span class="badge bg-success">Dikonfirmasi</span>
                                    @elseif ($p->status == 'tidak diproduksi lagi')
                                        <span class="badge bg-danger">Tidak Diproduksi Lagi</span>
                                    @elseif ($p->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $p->status }}</span>
                                    @endif
                                </td>
                                                              
                                <td>
                                    <a href="{{ route('konfirm_request_stok.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Stok Awal</th>
                                <th>Permintaan Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
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
