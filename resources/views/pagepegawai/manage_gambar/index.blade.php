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
                            <li class="breadcrumb-item active" aria-current="page">Manage Gambar</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Barang</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $index => $barang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->jenisBarang->nama }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#imageModal{{ $barang->id }}">
                                                Lihat Gambar
                                            </button>
                                        </td>

                                        <td>
                                            <a href="{{ route('manage_gambar.manage', $barang->id) }}"
                                                class="btn btn-sm btn-warning">Manage Gambar</a>
                                        </td>
                                    </tr>

                                    <!-- Modal for Images -->
                                    <div class="modal fade" id="imageModal{{ $barang->id }}" tabindex="-1"
                                        aria-labelledby="imageModalLabel{{ $barang->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel{{ $barang->id }}">Gambar
                                                        Barang {{ $barang->nama }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @if ($barang->gambar && count($barang->gambar) > 0)
                                                            @foreach ($barang->gambar as $img)
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                                                    <div class="card">
                                                                        <img src="{{ asset($img) }}" alt="Gambar Barang"
                                                                            class="img-fluid"
                                                                            style="width: 100%; height: auto;">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <p>Tidak ada gambar yang tersedia untuk barang ini.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
