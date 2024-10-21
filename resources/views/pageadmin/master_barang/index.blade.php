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
                            <li class="breadcrumb-item active" aria-current="page">Master Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Master Barang</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Jenis Barang</th>
                                    <th>Merk Barang</th>
                                    <th>Harga Modal</th>
                                    <th>Harga Jual</th>
                                    <th>Gambar</th>
                                    <th>Opsi Barang</th>
                                    <th>Stok Barang</th>
                                    <th>Berat Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $index => $barang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->deskripsi }}</td>
                                        <td>{{ $barang->jenisBarang->nama }}</td>
                                        <td>{{ $barang->merkBarang->nama }} <br>
                                            @if (isset($barang->merkBarang->logo))
                                            <div class="mb-2">
                                                <img src="{{ asset($barang->merkBarang->logo) }}" alt="logo" class="img-thumbnail"
                                                width="50px" height="auto">
                                            </div>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($barang->harga_modal, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#imageModal{{ $barang->id }}">
                                                Lihat Gambar
                                            </button>
                                        </td>
                                        <td>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex flex-column">
                                                    @if ($barang->opsi_barang && is_array($barang->opsi_barang))
                                                        @foreach ($barang->opsi_barang as $item)
                                                            <span class="badge bg-success mb-1 mt-1">{{ $item['opsi'] }}</span>
                                                            <div>
                                                                @foreach ($item['subopsi'] as $subopt)
                                                                    <span class="badge bg-secondary me-1">{{ $subopt }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-danger">Tidak ada opsi</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $barang->stok }}
                                        </td>
                                        <td>
                                            {{ $barang->berat }} Gram
                                        </td>
                                        <td>
                                            <a href="{{ route('barang.edit', $barang->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                                style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal for Images -->
                                    <div class="modal fade" id="imageModal{{ $barang->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $barang->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel{{ $barang->id }}">Gambar Barang {{ $barang->nama }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        @if ($barang->gambar && count($barang->gambar) > 0)
                                                            @foreach ($barang->gambar as $img)
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                                                    <div class="card">
                                                                        <img src="{{ asset($img) }}" alt="Gambar Barang" class="img-fluid" style="width: 100%; height: auto;">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <p>Tidak ada gambar yang tersedia untuk barang ini.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
