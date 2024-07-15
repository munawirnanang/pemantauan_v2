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
                        <form id="tambah_role">
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
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                                <div id="namanotif"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fitur" class="control-label">Fitur</label>
                                                <select class="selectpicker" id="fitur" multiple="multiple" name="fitur[]" data-style="btn-default" required>
                                                    <?php foreach ($fitur as $f) : ?>
                                                        <option value="<?= $f['id'] ?>"><?= $f['nama_fitur'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <div id="fiturnotif"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" id="csrf" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="tambah">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal -->

                <table id="table_role" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="min-width: 5%;">
                                <center><b>No.</b></center>
                            </th>
                            <th style="min-width: 15%;">
                                <center><b>User Name</b></center>
                            </th>
                            <th style="width: 60%;">
                                <center><b>Role</b></center>
                            </th>
                            <th style="min-width: 20%;">
                                <center><b>Action</b></center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
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
        <!-- <form action="<?= base_url('edit_role') ?>" method="POST"> -->
        <form id="ubah_role">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Data Role</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="editid" name="editid" placeholder="ID" readonly required>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="editnama" name="editnama" placeholder="Nama" required>
                                <div id="editnamanotif"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fitur" class="control-label">Fitur</label>
                                <select class="selectpicker" id="editfitur" multiple="multiple" name="editfitur[]" data-style="btn-default">
                                    <?php foreach ($fitur as $f) : ?>
                                        <option value="<?= $f['id'] ?>"><?= $f['nama_fitur'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div id="editfiturnotif"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CSRF Token Field -->
                <input type="text" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light" id="tambah">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>