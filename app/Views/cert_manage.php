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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('sbadmin');?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('sbadmin');?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <link href="<?= base_url('datepicker');?>/tempusdominus/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    

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
                      <h1 class="h4 mb-0 text-gray-800">Certificate Management</h1>
                      <a href="#" class="d-none d-sm-inline-block btn btn-primary btn-icon-split btn-sm shadow-sm" data-toggle="modal" data-target="#createModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Certificate</span> </a>
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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                    <form id="form-download" action="<?= base_url('Home/downloadFile')?>" method="post">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Certificate</h6>
                        
                        <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-file-download"></i>
                            </span>
                            <span class="text">Download</span>
                        </button>
                        
                    </div>
                        
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="example" name="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th colspan="1">No</th>
                                            <th colspan="1">Nama</th>
                                            <th colspan="1">Nama Pelatihan</th>
                                            <th colspan="1">Tanggal Pelatihan</th>
                                            <th colspan="1">Penyelenggara</th>
                                            <th colspan="1">Berlaku</th>
                                            <th colspan="1">Batas Berlaku</th>
                                            <th colspan="1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;?>
                                        <?php foreach($data_cert as $dc):?>
                                        <tr>
                                            <td ><?= $dc['id_cert'];?></td>
                                            <td><?= $i++;?></td>
                                            <td><?= $dc['name'];?></td>
                                            <td><?= $dc['training_name'];?></td>
                                            <td><?= $dc['training_date'];?></td>
                                            <td><?= $dc['organizer'];?></td>
                                            <td><?= $dc['from_date'];?></td>
                                            <td><?= $dc['to_date'];?></td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="<?= base_url('Home/editCertView/') . '/' . $dc['id_cert'];?>" class="d-none d-sm-inline-block btn btn-sm btn-info mr-2"><i class="far fa-edit"></i></a> 
                                                    <a href="<?= base_url('Home/deleteCert/') . '/' . $dc['id_cert'] . '/' . $dc['name_cert'];?>" class="d-none d-sm-inline-block btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        </form>

                    </div>

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

     <!-- createModal-->
 <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Certificate</h6>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form class="user" action="<?= base_url('Home/addCert');?>" method="post" enctype="multipart/form-data">
                    <?php csrf_field(); ?>
                    <div class="modal-body">

                        <div class="form-group">
                                <input type="text" class="form-control"
                                    id="name" name="name" placeholder="Nama">
                        </div>

                        <div class="form-group">
                                <input type="text" class="form-control"
                                    id="name_training" name="name_training" placeholder="Nama Pelatihan">
                        </div>


                        <div class="form-group">
                            <label>Tanggal Pelatihan</label>
                            <div class="input-group date" id="datepick_training" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="datepick_training" id="datepick_training" data-target="#datepick_training"/>
                                <div class="input-group-append" data-target="#datepick_training" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <input type="text" class="form-control"
                                    id="organizer" name="organizer" placeholder="Penyelenggara">
                        </div>

                        <div class="form-group">
                            <label>Masa Berlaku Sertifikat</label>

                            <div class="row">
                                <div class="col">
                                    <div class="input-group date" id="from_pick" data-target-input="nearest">
                                        <input type="text" id="from_pick" name="from_pick" class="form-control datetimepicker-input" data-target="#from_pick"/>
                                        <div class="input-group-append" data-target="#from_pick" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group date" id="to_pick" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="to_pick" name="to_pick" data-target="#to_pick"/>
                                        <div class="input-group-append" data-target="#to_pick" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="certificate_add" name="certificate_add">
                                <label class="custom-file-label" for="certificate_file" aria-describedby="inputGroupFileAddon02">Pilih Sertifikat</label>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Note : Format file berupa pdf</small>
                        </div>  

                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Tambah</button>
                    </div>
                </form>

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
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>


    <!-- Include library Moment JS -->
    <script src="<?= base_url('datepicker');?>/moment/moment.min.js"></script>

    <!-- Include library Datepicker Gijgo -->
    <script src="<?= base_url('datepicker');?>/tempusdominus/tempusdominus-bootstrap-4.min.js"></script>

                                                          
    <script>

        $(function () {
                    $('#from_pick').datetimepicker({
                        format: "YYYY-MM-DD",
                    });
                });

        $(function () {
                    $('#to_pick').datetimepicker({
                        format: "YYYY-MM-DD"
                    });
                });

        $(function () {
                    $('#datepick_training').datetimepicker({
                        format: "YYYY-MM-DD"
                    });
                });

        $(document).on('change', '.custom-file-input', function (event) {
            $(this).next('.custom-file-label').html(event.target.files[0].name);
        });

        $(document).ready(function (){
        var table = $('#example').DataTable({
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                    'selectRow': true
                    }
                }
            ],
            'select': {
                'style': 'multi'
            },
            'order': [[1, 'asc']]
            });
        
            $('#form-download').on('submit', function(e){
            e.preventDefault();
            
            var form = this;
            var rows_selected = table.column(0).checkboxes.selected();
            
            // Remove added elements
            $('input[name="id\[\]"]', form).remove();


            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId){
                // Create a hidden element 
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });

            form.submit();
            
            
            });
        });
    </script>

</body>

</html>