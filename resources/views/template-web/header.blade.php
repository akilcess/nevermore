<header>
    <div class="topbar d-flex align-items-center">
        <div class="container">
            <nav class="navbar navbar-expand">
                <div class="topbar-logo-header">
                    <h4 class="logo-text text-dark">Nevermore</h4>
                </div>
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>

                <div class="top-menu ms-auto d-flex align-items-center">
                    <ul class="navbar-nav align-items-center d-flex">
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                href="/keranjang" role="button" aria-expanded="false">
                                <span class="alert-count">
                                    {{ Auth::check() ? \App\Models\Keranjang::where('user_id', Auth::id())->count() : 0 }}
                                </span>
                                <i class='bx bx-shopping-bag'></i>
                            </a>

                        </li>
                    </ul>
                </div>

                <div class="user-box dropdown">
                    @php
                        use App\Models\RegisterUser;
                        if (Auth::check()) {
                            $auth = Auth::user();
                            $profileuser = RegisterUser::where('user_id', $auth->id)->firstOrFail();
                        }
                    @endphp

                    {{-- Check if the user is authenticated --}}
                    @auth
                        <!-- TAMPILKAN JIKA SUDAH LOGIN -->
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $profileuser->profil ? asset('uploads/profil/' . $profileuser->profil) : 'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png' }}"
                                class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ Auth::user()->nama }}</p> <!-- Show user name -->
                                <p class="designattion mb-0"><span>@</span>{{ Auth::user()->username }}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}"><i
                                        class="bx bx-user"></i><span>Profile</span></a></li>
                            <li><a class="dropdown-item" href="/pesanansaya"><i
                                        class="bx bx-store"></i><span>Pesanan Saya</span></a></li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/logout">
                                    <i class="bx bx-log-out-circle"></i><span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    @else
                        <!-- JIKA BELUM LOGIN -->
                        <div class="d-flex gap-3">
                            <a href="/login" class="btn btn-sm btn-outline-dark px-5 d-none d-md-inline">Login</a>
                            <a href="/register" class="btn btn-sm btn-dark px-5 d-none d-md-inline">Register</a>
                        </div>

                        <!-- Tombol yang akan muncul di mode mobile (disembunyikan di layar besar) -->
                        <div class="d-flex justify-content-center d-md-none mb-1">
                            <a href="/login" class="btn btn-sm btn-dark">Login</a>
                        </div>
                    @endauth
                </div>
            </nav>
        </div>
    </div>
</header>
