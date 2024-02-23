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
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title m-b-15"><b>Manajemen Data Role</b></h4>
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary btn-rounded width-md waves-effect waves-light m-r-5 m-b-15" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-user-plus"></i> Tambah Data Role</button>
                        </div>
                        
                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <form action="<?= base_url('tambah_role') ?>" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Tambah Data Role</h4>
                                    </div>
                                    <div class="modal-body">
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
                                                    <label for="fitur" class="control-label">Fitur</label>
                                                    <select class="selectpicker" multiple="multiple" name="fitur[]" data-style="btn-default">
                                                        <?php foreach($fitur as $f) :?>
                                                            <option value="<?= $f['id'] ?>"><?= $f['nama_fitur'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <?= form_error('fitur','<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-info waves-effect waves-light" id="tambah">Tambah</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div><!-- /.modal -->
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash')?>"></div>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama Roles</th>
                                    <th colspan="<?= count($fitur) ?>">Fitur</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <?php foreach ($fitur as $i) : ?>
                                        <th><?= $i['nama_fitur'] ?></th>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($data_tabel as $u) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $u['nama_role'] ?></td>
                                        <?php foreach ($fitur as $f) : ?>
                                            <td>
                                            <?php $ceklis = false; ?>
                                                <?php foreach ($role_fitur as $rf) :?> 
                                                    <?php if ($rf['id_role'] == $u['id'] && $rf['id_fitur'] == $f['id']) :?>
                                                        <?php $ceklis = true; ?>
                                                        <?php endif?>
                                                <?php endforeach ?>
                                                    <input type="hidden" id="id_user" name="id_user" value="<?=$u['id']?>">
                                                    <input type="checkbox" name="fitur" id="fitur" value="<?= $f['id'] ?>" <?= $ceklis ? 'checked' : '' ?>>
                                                </div>
                                            </td>
                                        <?php endforeach ?>
                                        <td>
                                            <button class="btn btn-icon btn-rounded waves-effect waves-light btn-warning m-b-5 edit-btn" data-toggle="modal" data-target="#modal-edit" id="edit" name="edit" nama-edit="<?= $u['nama_role']?>" id-edit="<?= $u['id'] ?>" ><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-icon btn-rounded waves-effect waves-light btn-danger m-b-5" id="hapus" name="hapus" nama-hapus="<?= $u['nama_role'] ?>" id-hapus="<?= $u['id']?>" action="hapus_role"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach ?>
                            </tbody>
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
        <form action="<?= base_url('edit_role') ?>" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Data Role</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama</label>
                            <input type="text" class="form-control" id="editnama" name="editnama" placeholder="Nama">
                            <?= form_error('nama','<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info waves-effect waves-light" id="tambah">Edit</button>
            </div>
        </div>
        </form>
    </div>
</div>