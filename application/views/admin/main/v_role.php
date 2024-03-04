<div class="content-page" style="margin-top: 20px;">
    <!-- Start content -->
    <div class="content">
        <div class="container" style="width: 93%;">

            <div class="row">
                <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h4 class="m-t-0 header-title m-b-15"><b>Manajemen Data Role</b></h4>
                        <button type="button" class="btn btn-primary waves-effect waves-light m-b-15" style="border-radius: 0px;" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-user-plus"></i> Tambah Data Role</button>
                    </div>
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
                                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fitur" class="control-label">Fitur</label>
                                                <select class="selectpicker" multiple="multiple" name="fitur[]" data-style="btn-default">
                                                    <?php foreach ($fitur as $f) : ?>
                                                        <option value="<?= $f['id'] ?>"><?= $f['nama_fitur'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <?= form_error('fitur', '<small class="text-danger pl-3">', '</small>') ?>
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
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash') ?>"></div>

                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <center>No.</center>
                            </th>
                            <th>
                                <center>User Name</center>
                            </th>
                            <th>
                                <center>Roles</center>
                            </th>
                            <th>
                                <center>Action</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data_tabel as $u) :
                        ?>
                            <tr>
                                <td>
                                    <center><?= $i ?></center>
                                </td>
                                <td><?= $u['nama_role'] ?></td>
                                <td>
                                    <?php foreach ($fitur as $f) : ?>
                                        <?php foreach ($role_fitur as $rf) : ?>
                                            <?php if ($rf['id_role'] == $u['id'] && $rf['id_fitur'] == $f['id']) : ?>
                                                <span class="label label-default"><?= $f['nama_fitur'] ?></span>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endforeach ?>
                                </td>
                                <td>
                                    <center>
                                        <button class="btn btn-sm btn-warning waves-effect waves-light edit-btn" style="border-radius: 0px;" data-toggle="modal" data-target="#modal-edit" id="edit" name="edit" nama-edit="<?= $u['nama_role'] ?>" id-edit="<?= $u['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                        <button class="btn btn-sm btn-danger waves-effect waves-light" style="border-radius: 0px;" id="hapus" name="hapus" nama-hapus="<?= $u['nama_role'] ?>" id-hapus="<?= $u['id'] ?>" action="hapus_role"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </center>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        endforeach
                        ?>
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
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
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