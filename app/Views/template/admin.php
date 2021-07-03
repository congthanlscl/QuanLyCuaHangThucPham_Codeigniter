<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý cửa hàng thực phẩm</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href= "<?=base_url()?>/plugins/fontawesome-free/css/all.min.css">
    <link rel = "icon" href ="../../dist/home/img/icons/icon_website.png" type = "image/x-icon"> 
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url()?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/dist/css/admin.css">

    <link rel="stylesheet" href="<?=base_url()?>/plugins/tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery -->
    <script src="<?=base_url()?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?=base_url()?>/plugins/tagsinput/bootstrap-tagsinput.js"></script>

    <!-- jquery UI  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
    .label-info, .badge-info {
        background-color: #3a87ad;
    }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
                </a>
            </li> -->
            <li class="nav-item dropdown" title="Tuỳ chọn">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-cogs"></i>
                </a>
                <div class="dropdown-menu">
                    <span class="dropdown-item dropdown-header">Tuỳ chọn</span>
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url("admin/changePassword")?>" class="dropdown-item" >
                        <i class="fas fa-key"></i></i> Đổi mật khẩu
                    </a>
                    <a href="<?=base_url("admin/logout")?>" class="dropdown-item" >
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?=base_url("admin/dashboard")?>" class="brand-link">
            <!-- <img src="../../dist/img/logo/logohinh.png" alt="Gofi logo" class="brand-image" > -->
            <span class="brand-text font-weight-light">Quản lý cửa hàng thực phẩm</span>
        </a>

            <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!-- <div class="image">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div> -->
                <!-- <div class="info">
                    <a href="#" class="d-block"><?=userdata("username")?></a>
                </div> -->
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item <?=(strpos(segment(2), "dashboard") !== false) ? "menu-open" : ""?>">
                        <a href="<?=base_url("admin/dashboard")?>" class="nav-link <?=(strpos(segment(2), "dashboard") !== false) ? "active" : ""?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?=(segment(1) == "order") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("order")?>" class="nav-link <?=(segment(1) == "order") ? "active" : ""?>">
                            <i class="fas fa-cart-plus"></i>
                            <p>
                                Quản lý bán hàng
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("order")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "order") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách đơn hàng</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("order/addOrder")?>" class="nav-link <?=(segment(2) == "addOrder") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm đơn hàng</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "warehouse") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("warehouse")?>" class="nav-link <?=(segment(1) == "warehouse") ? "active" : ""?>">
                            <i class="fas fa-warehouse"></i>
                            <p>
                                Quản lý nhà kho
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("warehouse")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "warehouse") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách nhà kho</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("warehouse/addWarehouse")?>" class="nav-link <?=(segment(2) == "addWarehouse") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm nhà kho</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "purchase") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("purchase")?>" class="nav-link <?=(segment(1) == "purchase") ? "active" : ""?>">
                            <i class="fas fa-truck"></i>
                            <p>
                                Quản lý nhập kho
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("purchase")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "purchase") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách nhập kho</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("purchase/addPurchase")?>" class="nav-link <?=(segment(2) == "addPurchase") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm nhập kho</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "inventory") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("inventory")?>" class="nav-link <?=(segment(1) == "inventory") ? "active" : ""?>">
                            <i class="far fa-list-alt"></i>
                            <p>
                                Quản lý tồn kho
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("inventory")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "inventory") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách tồn kho</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "provider") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("provider")?>" class="nav-link <?=(segment(1) == "provider") ? "active" : ""?>">
                            <i class="fas fa-user-tie"></i>
                            <p>
                                Quản lý nhà cung cấp
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("provider")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "provider") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách nhà cung cấp</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("provider/addProvider")?>" class="nav-link <?=(segment(2) == "addProvider") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm nhà cung cấp</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "customer") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("customer")?>" class="nav-link <?=(segment(1) == "customer") ? "active" : ""?>">
                            <i class="fas fa-users"></i>
                            <p>
                                Quản lý khách hàng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?=(segment(1) ==  "categories") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("categories")?>" class="nav-link <?=(segment(1) ==  "categories") ? "active" : ""?>">
                            <i class="fas fa-th"></i>
                            <p>
                                Quản lý danh mục
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("categories")?>" class="nav-link <?=(segment(2) == "" && segment(1) ==  "categories") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách danh mục</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("categories/addCategories")?>" class="nav-link <?=(segment(2) == "addCategories") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm danh mục</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "units") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("units")?>" class="nav-link <?=(segment(1) == "units") ? "active" : ""?>">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                            <p>
                                Quản lý đơn vị
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("units")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "units" ) ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách đơn vị</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("units/addUnits")?>" class="nav-link <?=(segment(2) == "addUnits") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm đơn vị</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "products") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("products")?>" class="nav-link <?=(segment(1) == "products") ? "active" : ""?>">
                            <i class="fab fa-product-hunt"></i>
                            <p>
                                Quản lý sản phẩm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("products")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "products" ) ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách sản phẩm</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("products/addProducts")?>" class="nav-link <?=(segment(2) == "addProducts") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm sản phẩm</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?=(segment(1) == "tags") ? "menu-open" : "" ?>">
                        <a href="<?=base_url("tags")?>" class="nav-link <?=(segment(1) == "tags") ? "active" : ""?>">
                            <i class="fas fa-tags"></i>
                            <p>
                                Quản lý nhãn
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("tags")?>" class="nav-link <?=(segment(2) == "" && segment(1) == "tags") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách nhãn</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("tags/addTags")?>" class="nav-link <?=(segment(2) == "addTags") ? "active" : ""?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm nhãn</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?=$title?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?=base_url("admin")?>">Admin</a></li>
                    <li class="breadcrumb-item active"><?=$title?></li>
                    </ol>
                </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <?php
                try
                {
                    echo view($view);
                }
                catch (Exception $e)
                {
                    echo "<pre><code>$e</code></pre>";
                }
            ?>
            </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2021 <a href="<?=base_url()?>"><?=$_SERVER['SERVER_NAME']?></a></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
    var BASE = '<?=base_url()?>';
    var token = '<?=csrf_hash()?>';
</script>
<!-- DataTables  & Plugins -->
<script src="<?=base_url()?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?=base_url()?>/plugins/moment/moment.min.js"></script>
<script src="<?=base_url()?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- ckeditor -->
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script src="<?=base_url()?>/plugins/ckfinder/ckfinder.js"></script>
<!--  App -->
<script src="<?=base_url()?>/dist/js/adminlte.min.js"></script>
<script src="<?=base_url()?>/dist/js/main.js"></script>
<!--  for demo purposes -->
<script src="<?=base_url()?>/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {

    $('.tags-input').tagsinput({

    });
    
    bsCustomFileInput.init();
    
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    if(document.getElementById('example1')){

        var countColumn = document.getElementById('example1').rows[0].cells.length;
        var indexColumn = [];
        for(let i = 1; i < countColumn - 1; i++){
            indexColumn.push(i);
        }
        $("#example1").DataTable({
            "responsive": true, "pageLength":25, "autoWidth": false,
            "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ],
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: indexColumn
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: indexColumn
                            }
                        }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
});
</script>

</body>
</html>
