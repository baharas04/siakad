<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIAKAD - <?= $title; ?> </title>
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/panel/') ?>js/select.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>css/vertical-layout-light/style.css">
    <!-- <link rel="shortcut icon" href="<?= base_url('foto/logo.jpg') ?>" /> -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-md-10 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <center>
                                <div class="brand-logo">
                                    <!-- <img src="<?= base_url('foto/logo.png') ?>" alt="logo"> -->
                                </div>
                                <h4>Login Website SIAKAD SD N Kedungmulyo</h4>
                                <h6 class="font-weight-light">Silahkan Login</h6>
                            </center>
                            <form method="post" action="<?= base_url('home') ?>" class="pt-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="<?= base_url('assets/panel/') ?>vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url('assets/panel/') ?>vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('assets/panel/') ?>vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/panel/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/dataTables.select.min.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/off-canvas.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/template.js"></script>
    <script src="<?= base_url('assets/panel/') ?>js/settings.js"></script>
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
                    title: 'Great!',
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