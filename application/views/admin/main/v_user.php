<div class="content-page" style="margin-top: 20px;">
    <!-- Start content -->
    <div class="content">
        <div class="container" style="width: 93%;">

            <div class="row">
                <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h4 class="m-t-0 header-title m-b-15"><b>Manajemen Data Pengguna</b></h4>
                        <button type="button" class="btn btn-primary waves-effect waves-light m-b-15" style="border-radius: 0px;" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-user-plus"></i> Tambah Data Pengguna</button>
                    </div>
                </div>
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <form id="tambah_user">
                            <!-- <?php echo form_open('tambah_user'); ?> -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Tambah Data Pengguna</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userid" class="control-label">User ID</label>
                                                <input type="text" class="form-control" id="userid" name="userid" placeholder="User ID" required>
                                                <div id="useridnotif"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="control-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                                <div id="emailnotif"></div>
                                            </div>
                                        </div>
                                    </div>
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
                                                <label for="role" class="control-label">Role</label>
                                                <select class="selectpicker show-tick" name="role" data-style="btn-default" required>
                                                    <?php foreach ($role as $f) : ?>
                                                        <option value="<?= $f['id'] ?>"><?= $f['nama_role'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <div id="rolenotif"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- CSRF Token Field -->
                                <input type="text" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="tambah">Tambah</button>
                                </div>
                            </div>
                            <!-- <?php echo form_close(); ?> -->
                        </form>
                    </div>
                </div><!-- /.modal -->
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash') ?>"></div>

                <!-- <table id="example" class="table table-striped table-bordered">
                </table> -->

                <table id="table_user" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;">
                                <center><b>No.</b></center>
                            </th>
                            <th style="width: 15%;">
                                <center><b>User ID</b></center>
                            </th>
                            <th style="width: 20%;">
                                <center><b>Nama</b></center>
                            </th>
                            <th style="width: 20%;">
                                <center><b>Email</b></center>
                            </th>
                            <th style="width: 10%;">
                                <center><b>Role</b></center>
                            </th>
                            <th style="width: 10%;">
                                <center><b>Last Access</b></center>
                            </th>
                            <th style="width: 20%;">
                                <center><b>Action</b></center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>
</div>

<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form id="ubah_user">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit data Pengguna</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="editid" name="editid" placeholder="ID" readonly required>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userid" class="control-label">User ID</label>
                                <input type="text" class="form-control" id="edituserid" name="edituserid" placeholder="User ID" readonly required>
                                <div id="edituseridnotif"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="editemail" name="editemail" placeholder="Email" required>
                                <div id="editemailnotif"></div>
                            </div>
                        </div>
                    </div>
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
                                <label for="role" class="control-label">Role</label>
                                <select class="selectpicker show-tick" id="editrole" name="editrole" data-style="btn-default" required>
                                    <?php foreach ($role as $f) : ?>
                                        <option value="<?= $f['id'] ?>"><?= $f['nama_role'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div id="editrolenotif"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CSRF Token Field -->
                <input type="text" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>