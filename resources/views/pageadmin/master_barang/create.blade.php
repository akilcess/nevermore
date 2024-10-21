@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Page Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Master Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Tambah Barang -->
            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Tambah Barang</h5>
                            </div>
                            <hr>
                            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data"
                                class="row g-3">
                                @csrf
                                <!-- Nama Barang -->
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <!-- Jenis Barang -->
                                <div class="col-md-12">
                                    <label for="jenis_barang_id" class="form-label">Jenis Barang</label>
                                    <select class="form-control" id="jenis_barang_id" name="jenis_barang_id" required>
                                        <option value="">Pilih Jenis Barang</option>
                                        @foreach ($jenisBarangs as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- merk_barang_id Barang -->
                                <div class="col-md-12">
                                    <label for="merk_barang_id" class="form-label">Merk Barang</label>
                                    <select class="form-control" id="merk_barang_id" name="merk_barang_id" required>
                                        <option value="">Pilih Merk Barang</option>
                                        @foreach ($merkBarangs as $merk)
                                            <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-6">
                                    <label for="harga_modal" class="form-label">Harga Modal</label>
                                    <input type="number" class="form-control" id="harga_modal" name="harga_modal" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                                </div>

                                <!-- stok -->
                                <div class="col-md-6">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" required>
                                </div>
                                <!-- berat -->
                                <div class="col-md-6">
                                    <label for="berat" class="form-label">Berat</label>
                                    <span class="text-danger">*satuan gram (jika 500gram gunakan 500)</span>
                                    <input type="number" class="form-control" id="berat" name="berat" step="0.01" min="0" required>
                                </div>
                                

                              
                                <hr>
                                <hr>
                                <!-- Gambar -->
                                <div class="col-md-12">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <div id="gambarContainer">
                                        <div class="gambar-group">
                                            <input type="file" class="form-control mb-2" name="gambar[]" required>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="removeGambar(this)"><i class='bx bxs-trash'></i></button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="addImage">Tambah
                                        Gambar</button>
                                </div>
                                <hr>
                                <hr>
                                <div class="col-md-12">
                                    <label for="opsi" class="form-label">OPSI DAN SUB OPSI</label>
                                    <div id="opsiFields">
                                        <div class="opsi-group">
                                            <label for="opsi">OPSI :</label>
                                            <input type="text" name="opsi[]" class="form-control">
                                            <div class="subopsi-group ps-4 mt-2">
                                                <label for="subopsi">SUB OPSI:</label>
                                                <input type="text" name="subopsi[0][]" class="form-control ml-3">
                                            </div>
                                            <button type="button" class="btn btn-sm btn-warning mt-3"
                                                onclick="addSubopsi(this, 0)"><i class='bx bx-list-plus'></i></button>
                                            <button type="button" class="btn btn-sm btn-danger mt-3"
                                                onclick="removeOpsi(this)"><i class='bx bxs-trash'></i></button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-success" onclick="addOpsi()">Tambah
                                    Opsi</button>
                                <hr>
                                <hr>

                                <!-- Submit Button -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary px-5">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to add/remove dynamic fields -->
    <script>
        document.getElementById('addImage').addEventListener('click', function() {
            let container = document.getElementById('gambarContainer');
            let newGroup = document.createElement('div');
            newGroup.classList.add('gambar-group');
            newGroup.innerHTML = `
            <input type="file" class="form-control mb-2 mt-2" name="gambar[]" required>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeGambar(this)"><i class='bx bxs-trash' ></i></button>
        `;
            container.appendChild(newGroup);
        });

        function removeGambar(button) {
            button.parentElement.remove();
        }

        let opsiIndex = 0;

        function addOpsi() {
            opsiIndex++;
            let opsiFields = document.getElementById('opsiFields');
            let opsiGroup = document.createElement('div');
            opsiGroup.classList.add('opsi-group');
            opsiGroup.innerHTML = `
            <label for="opsi">OPSI :</label>
            <input type="text" name="opsi[]" class="form-control">
            <div class="subopsi-group ps-4 mt-2">
                <label for="subopsi">SUB OPSI :</label>
                <input type="text" name="subopsi[${opsiIndex}][]" class="form-control">
            </div>
            <button type="button" class="btn btn-sm btn-warning mt-3" onclick="addSubopsi(this, ${opsiIndex})"><i class='bx bx-list-plus'></i></button>
            <button type="button" class="btn btn-sm btn-danger mt-3" onclick="removeOpsi(this)"><i class='bx bxs-trash' ></i></button>
        `;
            opsiFields.appendChild(opsiGroup);
        }

        function addSubopsi(button, index) {
            let subopsiGroup = document.createElement('div');
            subopsiGroup.innerHTML = `
            <label for="subopsi">SUB OPSI :</label>
            <input type="text" name="subopsi[${index}][]" class="form-control">
        `;
            button.parentNode.querySelector('.subopsi-group').appendChild(subopsiGroup);
        }

        function removeOpsi(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
