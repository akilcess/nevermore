@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Master Barang</li>
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

            <!-- Form Edit Barang -->
            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Edit Barang</h5>
                            </div>
                            <hr>
                            <form action="{{ route('barang.update', $barang->id) }}" method="POST"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')

                                <!-- Nama Barang -->
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $barang->nama }}" required>
                                </div>

                                <!-- Jenis Barang -->
                                <div class="col-md-12">
                                    <label for="jenis_barang_id" class="form-label">Jenis Barang</label>
                                    <select class="form-control" id="jenis_barang_id" name="jenis_barang_id" required>
                                        <option value="">Pilih Jenis Barang</option>
                                        @foreach ($jenisBarangs as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ $barang->jenis_barang_id == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- merk Barang -->
                                <div class="col-md-12">
                                    <label for="merk_barang_id" class="form-label">Merk Barang</label>
                                    <select class="form-control" id="merk_barang_id" name="merk_barang_id" required>
                                        <option value="">Pilih Merk Barang</option>
                                        @foreach ($merkBarangs as $merk)
                                            <option value="{{ $merk->id }}"
                                                {{ $barang->merk_barang_id == $merk->id ? 'selected' : '' }}>
                                                {{ $merk->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $barang->deskripsi }}</textarea>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-6">
                                    <label for="harga_modal" class="form-label">Harga Modal</label>
                                    <input type="number" class="form-control" id="harga_modal" name="harga_modal"
                                        value="{{ $barang->harga_modal }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                        value="{{ $barang->harga_jual }}" required>
                                </div>
                                <!-- stok -->
                                <div class="col-md-6">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        value="{{ $barang->stok }}" required>
                                </div>
                                <!-- berat -->
                                <div class="col-md-6">
                                    <label for="berat" class="form-label">Berat</label>
                                    <span class="text-danger">*satuan kilo (jika 500gram gunakan 0.5)</span>
                                    <input type="number" class="form-control" id="berat" name="berat" step="0.01" min="0" 
                                        value="{{ $barang->berat }}" required>
                                </div>

                                <hr>
                                <hr>

                                <!-- Gambar -->
                                <div class="col-md-12">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <div id="gambarContainer" class="row">
                                        @foreach ($barang->gambar as $gambar)
                                            <div class="col-md-4 col-sm-6 col-12 mb-3">
                                                <div class="gambar-group">
                                                    <img src="{{ asset($gambar) }}" alt="gambar" class="img-thumbnail"
                                                        style="max-width: 100%;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="addImage">Tambah
                                        Gambar</button>
                                </div>

                                <hr>
                                <hr>

                                <!-- Opsi dan Sub Opsi -->
                                <div class="col-md-12">
                                    <label for="opsi" class="form-label">OPSI DAN SUB OPSI</label>
                                    <div id="opsiFields">
                                        @foreach ($barang->opsi_barang as $index => $opsi)
                                            <div class="opsi-group mb-3">
                                                <label for="opsi">OPSI :</label>
                                                <input type="text" name="opsi[]" class="form-control"
                                                    value="{{ $opsi['opsi'] }}">

                                                <!-- Sub Opsi with Indentation -->
                                                <div class="subopsi-group ps-4 mt-2">
                                                    <label for="subopsi">SUB OPSI:</label>
                                                    @foreach ($opsi['subopsi'] as $sub)
                                                        <input type="text" name="subopsi[{{ $index }}][]"
                                                            class="form-control mb-2 bg-secondary text-white"
                                                            value="{{ $sub }}">
                                                    @endforeach
                                                </div>

                                                <!-- Add/Remove Buttons -->
                                                <button type="button" class="btn btn-sm btn-warning mt-3"
                                                    onclick="addSubopsi(this, {{ $index }})">
                                                    <i class='bx bx-list-plus'></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger mt-3"
                                                    onclick="removeOpsi(this)">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-success mt-2" onclick="addOpsi()">Tambah
                                        Opsi</button>
                                </div>
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
        // Add new image input field
        document.getElementById('addImage').addEventListener('click', function() {
            let container = document.getElementById('gambarContainer');
            let newGroup = document.createElement('div');
            // Menghapus kelas grid
            newGroup.innerHTML = `<input type="file" class="form-control mb-2 mt-2" name="gambar[]">`;
            container.appendChild(newGroup);
        });


        // Add new opsi and subopsi fields
        function addOpsi() {
            let container = document.getElementById('opsiFields');
            let opsiIndex = container.children.length;

            let opsiGroup = document.createElement('div');
            opsiGroup.classList.add('opsi-group', 'mb-3');
            opsiGroup.innerHTML = `
                <label for="opsi">OPSI:</label>
                <input type="text" name="opsi[]" class="form-control">
                <div class="subopsi-group ps-4 mt-2">
                    <label for="subopsi">SUB OPSI:</label>
                    <input type="text" name="subopsi[${opsiIndex}][]" class="form-control bg-secondary text-white">
                </div>
                <button type="button" class="btn btn-sm btn-warning mt-3" onclick="addSubopsi(this, ${opsiIndex})">
                    <i class='bx bx-list-plus'></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger mt-3" onclick="removeOpsi(this)">
                    <i class='bx bxs-trash'></i>
                </button>
            `;
            container.appendChild(opsiGroup);
        }

        // Add new subopsi field
        function addSubopsi(button, opsiIndex) {
            let subopsiGroup = button.previousElementSibling;
            let subopsiInput = document.createElement('input');
            subopsiInput.type = 'text';
            subopsiInput.name = `subopsi[${opsiIndex}][]`;
            subopsiInput.classList.add('form-control', 'mt-2', 'bg-secondary', 'text-white');
            subopsiGroup.appendChild(subopsiInput);
        }

        // Remove opsi group
        function removeOpsi(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
