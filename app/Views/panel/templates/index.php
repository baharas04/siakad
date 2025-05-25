<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIAKAD - SD N Kedungmulyo - <?= $title; ?> </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/font-awesome/css/font-awesome.min.css" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/panel/') ?>js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>css/vertical-layout-light/style.css">
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="<?= base_url('foto/logo.jpg') ?>" /> -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
    <script src="<?= base_url('assets/panel/') ?>ckeditor/ckeditor.js"></script>
    <style>
        .ujian {
            table-layout: fixed;
            width: 100%;
        }

        .ujian td {
            max-width: 200px;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
            vertical-align: top;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5 ml-3" href="<?= base_url('panel/dashboard') ?>" style="font-size: 20px;">SD N Kedungmulyo</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="<?= base_url('foto/user.png') ?>" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?= base_url('panel/profiledit') ?>">
                                <i class="ti-settings text-primary"></i> Edit Profil
                            </a>
                            <a class="dropdown-item" href="<?= base_url('panel/logout') ?>">
                                <i class="ti-power-off text-primary"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <?php
        $background = "";
        if (session('level') == 'Admin') {
            $background = "";
        }
        if (session('level') == 'Guru') {
            $background = "bg-info";
        }
        if (session('level') == 'Siswa') {
            $background = "bg-success";
        }
        if (session('level') == 'Pimpinan') {
            $background = "bg-danger";
        }
        ?>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas <?= $background ?>" id="sidebar">
                <ul class="nav">
                    <?php
                    if (session('level') == 'Admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/dashboard') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/pengumuman') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/prestasi') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Prestasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/kurikulumdaftar') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Kurikulum</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/kegiatansekolahdaftar') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Kegiatan Sekolah</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/kelasdaftar') ?>">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title">Kelas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/matapelajarandaftar') ?>">
                                <i class="icon-columns menu-icon"></i>
                                <span class="menu-title">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/siswadaftar') ?>">
                                <i class="icon-grid-2 menu-icon"></i>
                                <span class="menu-title">Siswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/gurudaftar') ?>">
                                <i class="icon-head menu-icon"></i>
                                <span class="menu-title">Guru</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/penggunadaftar') ?>">
                                <i class="icon-head menu-icon"></i>
                                <span class="menu-title">Admin/Pimpinan</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/ujiandaftar') ?>">
                                <i class="icon-book menu-icon"></i>
                                <span class="menu-title">Ujian</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php
                    if (session('level') == 'Pimpinan') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/dashboard') ?>">
                                <i class="icon-grid menu-icon text-white"></i>
                                <span class="menu-title text-white">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/kelasdaftar') ?>">
                                <i class="icon-layout menu-icon text-white"></i>
                                <span class="menu-title text-white">Kelas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/matapelajarandaftar') ?>">
                                <i class="icon-columns menu-icon text-white"></i>
                                <span class="menu-title text-white">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/siswadaftar') ?>">
                                <i class="icon-grid-2 menu-icon text-white"></i>
                                <span class="menu-title text-white">Siswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/gurudaftar') ?>">
                                <i class="icon-head menu-icon text-white"></i>
                                <span class="menu-title text-white">Guru</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/ujiandaftar') ?>">
                                <i class="icon-book menu-icon text-white"></i>
                                <span class="menu-title text-white">Ujian</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php
                    if (session('level') == 'Guru') { ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/dashboard') ?>">
                                <i class="icon-grid menu-icon text-white"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/pengumuman') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/prestasi') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Prestasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="<?= base_url('panel/kurikulumdaftar') ?>">
                                <i class="icon-grid menu-icon  text-white"></i>
                                <span class="menu-title">Kurikulum</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/kegiatansekolahdaftar') ?>">
                                <i class="icon-grid menu-icon text-white"></i>
                                <span class="menu-title">Kegiatan Sekolah</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/kelasdaftar') ?>">
                                <i class="icon-layout menu-icon text-white"></i>
                                <span class="menu-title">Kelas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/matapelajarandaftar') ?>">
                                <i class="icon-columns menu-icon text-white"></i>
                                <span class="menu-title">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/siswadaftar') ?>">
                                <i class="icon-grid-2 menu-icon text-white"></i>
                                <span class="menu-title">Siswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/gurudaftar') ?>">
                                <i class="icon-head menu-icon text-white"></i>
                                <span class="menu-title">Guru</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('panel/ujiandaftar') ?>">
                                <i class="icon-book menu-icon text-white"></i>
                                <span class="menu-title text-white">Ujian</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php
                    if (session('level') == 'Siswa') { ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/dashboard') ?>">
                                <i class="icon-grid menu-icon text-white"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/pengumuman') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/prestasi') ?>">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Prestasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="<?= base_url('panel/kurikulumdaftar') ?>">
                                <i class="icon-grid menu-icon  text-white"></i>
                                <span class="menu-title">Kurikulum</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="<?= base_url('panel/kegiatansekolahdaftar') ?>">
                                <i class="icon-grid menu-icon text-white"></i>
                                <span class="menu-title">Kegiatan Sekolah</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/ujiandaftar') ?>">
                                <i class="icon-book menu-icon text-white"></i>
                                <span class="menu-title">Ujian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('panel/ujianriwayat') ?>">
                                <i class="icon icon-mail menu-icon text-white"></i>
                                <span class="menu-title">Riwayat Ujian</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $this->renderSection('page-content'); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/panel/') ?>vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url('assets/panel/') ?>vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('assets/panel/') ?>vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/panel/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/dataTables.select.min.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/off-canvas.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/template.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/todolist.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/dashboard.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/Chart.roundedBarCharts.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(function() {
            <?php if (session()->has("success")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= session("success") ?>'
                })
            <?php } ?>
        });
        $(function() {
            <?php if (session()->has("error")) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session("error") ?>'
                })
            <?php } ?>
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable();
        });
    </script>
</body>

</html>