<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('web') }}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('web') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('web') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('web') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('web') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/css/icons.css" rel="stylesheet">
    <title>Register</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center mt-3">
							<img src="{{ asset('env') }}/ecommerce.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
                                    
                                    <div class="login-separater text-center mb-4"> <span>REGISTER</span>
                                        <hr />
                                    </div><div class="text-center">
										<p>Sudah punya akun? <a href="/login">Masuk Disini</a>
										</p>
									</div>
                                    <div class="form-body">
                                        <form action="{{ route('registeruser.store') }}" method="POST" class="row g-3">
                                            @csrf
                                            <div class="col-md-6">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telepon" class="form-label">No HP Aktif</label>
                                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="province_id" class="form-label">Provinsi</label>
                                                <select class="form-control" id="province_id" name="province_id" required>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <label for="city_id" class="form-label">Kabupaten/Kota</label>
                                                <select class="form-control" id="city_id" name="city_id" required>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            
                                            <div class="col-12">
                                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                            </div>
                
                                            <!-- User Account Fields -->
                                            <div class="col-12">
                                                <hr>
                                                <h6 class="text-primary">Informasi Akun Pengguna</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                            </div>
                
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-outline-success px-5">DAFTARKAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    @include('sweetalert::alert')

    @yield('script')
    <!-- Bootstrap JS -->
    <script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('web') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('web') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('web') }}/assets/js/app.js"></script>
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
</body>

</html>
