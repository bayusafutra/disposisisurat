<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SIAP</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.png" type="image/x-icon">

    @yield('css')
    {{-- tambahan page lain --}}
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/summernote/summernote-lite.min.css">
    <!-- Masukkan CSS Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo" style="display: flex; align-content: center;">
                            <div class="row">
                                <div class="col-4">
                                    <a href="/dashboard">
                                        <img src="assets/images/logo/logo.png" alt="Logo" srcset="">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <small style="font-size: 15px; color: black; font-weight: 800">Kecamatan</small><br>
                                    <p style="font-size: 28px; margin-top: -20px; color: black; font-weight: 800">
                                        Purwosari</p>
                                </div>
                            </div>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                    <div class="identitas mt-2">
                        <div class="avatar avatar-xl d-flex justify-content-center">
                            <img src="assets/images/faces/user.png" style="height: 90px; width: 90px" alt="Face 1">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <small
                                style="font-weight: 900; font-size: 14px; color: #25396f; text-align: center">{{ ucwords(auth()->user()->name) }}</small>
                        </div>
                        <p style="font-size: 10px; text-align: center">{{ ucwords(auth()->user()->nip) }}</p>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @can('admin')
                            <li class="sidebar-item">
                                <a href="/tambahpegawai" class='sidebar-link'>
                                    <i class="bi bi-envelope"></i>
                                    <span>Tambah Pegawai</span>
                                </a>
                            </li>
                        @endcan

                        @can('camat')
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-envelope-fill"></i>
                                    <span>Data Surat</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="/daftarsuratmasuk">Surat Masuk</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="/daftarsuratkeluar">Surat Keluar</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-envelope"></i>
                                    <span>Validasi Persuratan</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="/validasisuratmasuk">Surat Masuk</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="/validasisuratkeluar">Surat Keluar</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('sekcam')
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-envelope"></i>
                                    <span>Persuratan</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="/suratmasuksekcam">Surat Masuk</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="/suratkeluarsekcam">Surat Keluar</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('operator')
                            <li class="sidebar-item">
                                <a href="/tambahsuratmasuk" class='sidebar-link'>
                                    <i class="bi bi-file-earmark-plus"></i>
                                    <span>Tambah Surat Masuk</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-envelope"></i>
                                    <span>Persuratan</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="/datasuratmasuk">Data Surat Masuk</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="/datasuratkeluar">Data Surat Keluar</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('kasikasubag')
                            <li class="sidebar-item">
                                <a href="/tambahsuratkeluar" class='sidebar-link'>
                                    <i class="bi bi-file-earmark-plus"></i>
                                    <span>Tambah Surat Keluar</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-envelope"></i>
                                    <span>Persuratan</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="/suratmasuk">Surat Masuk</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="/suratkeluar">Surat Keluar</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        <li class="sidebar-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class='sidebar-link' style="border: none; width: 100%">
                                    <i class="bi bi-box-arrow-in-left"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </li>

                        {{-- <li class="sidebar-title">Forms &amp; Tables</li> --}}

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        @yield('main')
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
    @yield('js')
</body>

</html>