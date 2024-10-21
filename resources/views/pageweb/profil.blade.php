@extends('template-web.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content position-relative">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="{{ $profileuser->profil ? asset('uploads/profil/' . $profileuser->profil) : 'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png' }}"
                                            alt="Profile Image" class="rounded-circle p-1 bg-light" width="100"
                                            height="100">
                                        <div class="mt-3">
                                            <h4>{{ $profileuser->nama }}</h4>
                                            <p class="text-secondary mb-1"><span>@</span>{{ $auth->username }}</p>
                                            <p>{{ $auth->email }}</p>
                                            <p class="text-muted font-size-sm">
                                                {{ $province->province ?? 'Not specified' }},
                                                {{ $city->city_name ?? 'Not specified' }},
                                                {{ $profileuser->alamat }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('profile.update', $profileuser->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="nama" class="form-control"
                                                    value="{{ $profileuser->nama }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $auth->email }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="telepon" class="form-control"
                                                    value="{{ $profileuser->telepon }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Provinsi</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select class="form-control select2" id="province_id" name="province_id" required>
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($provinces as $prov)
                                                        <option value="{{ $prov->province_id }}" {{ $prov->province_id == $profileuser->province_id ? 'selected' : '' }}>
                                                            {{ $prov->province }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Kabupaten/Kota</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <select class="form-control" id="city_id" name="city_id" required>
                                                    @foreach ($cities as $city)
                                                    <option value="{{ $city->city_id }}" {{ $city->city_id == $profileuser->city_id ? 'selected' : '' }}>
                                                        {{ $city->city_name }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="alamat" class="form-control"
                                                    value="{{ $profileuser->alamat }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Profile Image</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" name="profil" class="form-control" />
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="username" class="form-control"
                                                    value="{{ $auth->username }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Isi jika ingin diubah!">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" placeholder="Isi jika ingin diubah!">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4"
                                                    value="Save Changes" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#province_id').on('change', function() {
            var province_id = $(this).val();

            // Cek jika ada provinsi yang dipilih
            if (province_id) {
                $.ajax({
                    url: '/get-kabupaten/' + province_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city_id').empty(); // Kosongkan select kabupaten
                        $('#city_id').append('<option value="">Pilih Kota</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Pilih Kota</option>');
            }
        });
    });
</script>

    
@endsection