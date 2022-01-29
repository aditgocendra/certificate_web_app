<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title;?></title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('sbadmin');?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('sbadmin');?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('sbadmin');?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <link href="<?= base_url('datepicker');?>/tempusdominus/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-building"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sucofindo <sup>PT</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('Home');?>">
                    <i class="fas fa-fw fa-paste"></i>
                    <span>Certificate</span></a>
            </li>

         

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $profile_data[0]['username']?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('sbadmin/img') . '/' . $profile_data[0]['image_profile'];?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('Profile');?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                      <h1 class="h4 mb-0 text-gray-800">Edit Certificate</h1>
                    </div>

                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="<?= session()->getFlashdata('alert');?>" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                  <?php endif; ?>
                  
                  <?= $validation->listErrors() ?>
                
                        <form class="user" action="<?= base_url('Home/editCertificate');?>" method="post" enctype="multipart/form-data">
                        <?php csrf_field(); ?>

                            <input type="text" class="form-control" id="id_cert" name="id_cert" value="<?= $select_data[0]['id_cert'];?>" hidden>

                            <div class="form-group">
                                    <input type="text" class="form-control"
                                        id="name_edit" name="name_edit" value="<?= $select_data[0]['name'];?>" placeholder="Nama">
                            </div>

                            <div class="form-group">
                                    <input type="text" class="form-control"
                                        id="name_training_edit" name="name_training_edit" value="<?= $select_data[0]['training_name'];?>" placeholder="Nama Pelatihan">
                            </div>


                            <div class="form-group">
                                <label>Tanggal Pelatihan</label>
                                <div class="input-group date" id="datepick_training_edit" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" value="<?= $select_data[0]['training_date'];?>" name="datepick_training_edit" id="datepick_training_edit" data-target="#datepick_training_edit"/>
                                    <div class="input-group-append" data-target="#datepick_training_edit" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                    <input type="text" class="form-control"
                                        id="organizer_edit" name="organizer_edit" value="<?= $select_data[0]['organizer'];?>" placeholder="Penyelenggara">
                            </div>

                            <div class="form-group">
                                <label>Masa Berlaku Sertifikat</label>

                                <div class="row">
                                    <div class="col">
                                        <div class="input-group date" id="from_pick_edit" data-target-input="nearest">
                                            <input type="text" id="from_pick" name="from_pick_edit" value="<?= $select_data[0]['from_date'];?>" class="form-control datetimepicker-input" data-target="#from_pick_edit"/>
                                            <div class="input-group-append" data-target="#from_pick_edit" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="input-group date" id="to_pick_edit" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" id="to_pick_edit" name="to_pick_edit" value="<?= $select_data[0]['to_date'];?>" data-target="#to_pick_edit"/>
                                            <div class="input-group-append" data-target="#to_pick_edit" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="certificate_edit" name="certificate_edit" value="<?= base_url('certificate_file/') . '/' . $select_data[0]['name_cert'];?>">
                                    <label class="custom-file-label" for="certificate_file" aria-describedby="inputGroupFileAddon02"><?=$select_data[0]['name_cert'];?></label>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Note : Format file berupa pdf</small>
                            </div>  

                            <input type="text" id="certificate_name_old" name="certificate_name_old" value="<?=$select_data[0]['name_cert'];?>" hidden>
                        
                       
                            <a href="<?= base_url('Home');?>" class="btn btn-danger btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="far fa-window-close"></i>
                                </span>
                                <span class="text">Batal</span>
                            </a>

                            <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="far fa-save"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </button>
                        
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah yakin untuk logout ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('Auth/logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('sbadmin');?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('sbadmin');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('sbadmin');?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('sbadmin');?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('sbadmin');?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sbadmin');?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('sbadmin');?>/js/demo/datatables-demo.js"></script>

    <!-- Include library Moment JS -->
    <script src="<?= base_url('datepicker');?>/moment/moment.min.js"></script>

    <!-- Include library Datepicker Gijgo -->
    <script src="<?= base_url('datepicker');?>/tempusdominus/tempusdominus-bootstrap-4.min.js"></script>

   
    <script>

        $(function () {
                    $('#from_pick_edit').datetimepicker({
                        format: "YYYY-MM-DD",
                    });
                });

        $(function () {
                    $('#to_pick_edit').datetimepicker({
                        format: "YYYY-MM-DD"
                    });
                });

        $(function () {
                    $('#datepick_training_edit').datetimepicker({
                        format: "YYYY-MM-DD"
                    });
                });

        $(document).on('change', '.custom-file-input', function (event) {
            $(this).next('.custom-file-label').html(event.target.files[0].name);
        })
    </script>

    
   
</body>

</html>