<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/dist/css/adminlte.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" /> -->
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template_admin') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed text-sm">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark navbar-green">
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-light-green elevation-4">
      <a href="index3.html" class="brand-link navbar-green">
        <img src="<?= base_url('assets/images/') ?>stock.png" alt=" Inventory Kita" class="brand-image" style="">
        <span class="brand-text font-weight-bold" style="color: #ffffff;">Inventory Kita</span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url('barang') ?>" class="nav-link <?php if ($page == 'barang') echo "active"; ?>">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Master Barang
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url('list_nota') ?>" class="nav-link  <?php if ($page == 'pembelian') echo "active"; ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Transaksi Pembelian
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview <?php if ($page == 'kategori' || $page == 'vendor') echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if ($page == 'kategori' || $page == 'vendor') echo "active"; ?>">
                <i class="nav-icon fas fa-database"></i>
                <p>
                  Master
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('kategori') ?>" class="nav-link <?php if ($page == 'kategori') echo "active"; ?>">
                    <i class="fas fa-box-open nav-icon"></i>
                    <p>Kategori</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('vendor') ?>" class="nav-link <?php if ($page == 'vendor') echo "active"; ?>">
                    <i class="fas fa-store nav-icon"></i>
                    <p>Vendor</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url('distribusi') ?>" class="nav-link <?php if ($page == 'distribusi') echo "active"; ?>">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Detail Distribusi
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="list_permintaan_barang" class="nav-link <?php if ($page == 'permintaan') echo "active"; ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Permintaan Barang
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?= base_url('barang/cabang') ?>" class="nav-link <?php if ($page == 'cabang') echo "active"; ?>">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Barang Cabang
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <?= $content ?>
    </div>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>
  <script>
    var base_url = '<?php echo base_url() ?>';
  </script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('assets/template_admin') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="<?= base_url('assets/template_admin') ?>/plugins/select2/js/select2.full.min.js"></script>

  <script>
    $(function() {
      $('[data-mask]').inputmask();
      $('#datemask').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      $('[data-mask]').inputmask('dd-mm-yyyy')
      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
    })
  </script>

  <script>
    $('#example1').DataTable({

    });
  </script>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>