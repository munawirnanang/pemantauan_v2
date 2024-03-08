<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Datatable </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <!-- <a href="<?php echo base_url().$menu ?>"><?php echo $menu?></a> -->
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash')?>"></div>
                    <div class="card-box table-responsive">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4 class="m-t-0 header-title m-b-15"><b>Manajemen Data User</b></h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light m-b-15" style="border-radius: 0px;" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-user-plus"></i> Tambah Data User</button>
                        </div>
                        
                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <form action="<?= base_url('tambah_user') ?>" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Tambah data Pengguna</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userid" class="control-label">User ID</label>
                                                    <input type="text" class="form-control" id="userid" name="userid" placeholder="User ID">
                                                    <?= form_error('userid','<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                    <?= form_error('email','<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                                                    <?= form_error('nama','<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="role" class="control-label">Role</label>
                                                    <select class="selectpicker show-tick" name="role" data-style="btn-default">
                                                        <?php foreach($role as $f) :?>
                                                            <option value="<?= $f['id'] ?>"><?= $f['nama_role'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <?= form_error('role','<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Tambah</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div><!-- /.modal -->

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>User ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tag</th>
                                <th>Last Access</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1 ?>
                            <?php foreach($user as $u) : ?>
                            <tr>
                                <th><?= $i?></th>
                                <th><?= $u['userid']?></th>
                                <th><?= $u['nama']?></th>
                                <th><?= $u['email']?></th>
                                <th><?= $u['role']?></th>
                                <th><?= $u['last_access']?></th>
                                <th>    
                                    <button class="btn btn-icon btn-rounded waves-effect waves-light btn-warning m-b-5 edit-btn" data-toggle="modal" data-target="#modal-edit" data-edit="<?= $u['id'] ?>" data-userid="<?= $u['userid'] ?>" data-email="<?= $u['email'] ?>" data-nama="<?= $u['nama'] ?>" data-role="<?= $u['role'] ?>"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-icon btn-rounded waves-effect waves-light btn-danger m-b-5" id="hapus" name="hapus" nama-hapus="<?= $u['userid'] ?>" id-hapus="<?= $u['id']?>" action="hapus_user"><i class="fa fa-trash"></i></button>
                                </th>
                            </tr>
                            </tbody>
                            <?php $i++?>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>
</div>

<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit data Pengguna</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userid" class="control-label">User ID</label>
                            <input type="text" class="form-control" id="edituserid" name="edituserid" placeholder="User ID" readonly>
                            <?= form_error('userid','<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="editemail" name="editemail" placeholder="Email">
                            <?= form_error('email','<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama</label>
                            <input type="text" class="form-control" id="editnama" name="editnama" placeholder="Nama">
                            <?= form_error('nama','<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role" class="control-label">Role</label>
                            <select class="selectpicker show-tick" id="editrole" name="editrole" data-style="btn-default">
                                <?php foreach($role as $f) :?>
                                    <option value="<?= $f['id'] ?>"><?= $f['nama_role'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('role','<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
            </div>
        </div>
        </form>
    </div>
</div>