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
                            <li class="breadcrumb-item active" aria-current="page">Manage Gambar Barang</li>
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
                                <div><i class="bx bxs-image-add me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Manage Gambar Barang</h5>
                            </div>
                            <hr>
                            <form action="{{ route('manage_gambar.update', $barang->id) }}" method="POST"
                                enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')

                              

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
