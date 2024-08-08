<div class="content-page" style="margin-top: 20px;">
    <!-- Start content -->
    <div class="content">
        <div class="container" style="width: 93%;">

            <div class="row">
                <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h4 class="m-t-0 header-title m-b-15"><b>Manajemen Data Fitur</b></h4>
                        <button type="button" class="btn btn-primary waves-effect waves-light m-b-15" style="border-radius: 0px;" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-user-plus"></i> Tambah Data Fitur</button>
                    </div>
                </div>
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <form id="tambah_fitur">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Tambah Data Fitur</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama" class="control-label">Nama Fitur</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                                <div id="namanotif"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fitur" class="control-label">Parent Fitur</label>
                                                <select class="form-control" id="fitur" name="fitur">
                                                    <option value="" disabled selected>-- Nothing Selected --</option>
                                                    <!-- <option value=""><i>NULL</i></option> -->
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

                <table id="table_fitur" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;">
                                <center><b>No.</b></center>
                            </th>
                            <th style="width: 37.5%;">
                                <center><b>Nama Fitur</b></center>
                            </th>
                            <th style="width: 37.5%;">
                                <center><b>Parent Fitur</b></center>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-left" id="nestable_list_menu">
                        <button type="button" class="btn btn-pink waves-effect waves-light" data-action="expand-all">Expand All</button>
                        <button type="button" class="btn btn-purple waves-effect waves-light" data-action="collapse-all">Collapse All</button>
                    </div>
                </div>
            </div>
            <!-- End row -->

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-t-0 header-title"><b>Nestable Lists 1</b></h4>
                                <p class="text-muted m-b-30 font-13">
                                    Drag & drop hierarchical list with mouse and touch compatibility (jQuery plugin).
                                </p>

                                <div class="custom-dd dd" id="nestable_list_1">
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                Beranda
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="2">
                                            <div class="dd-handle">
                                                Indikator Makro
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="3">
                                            <div class="dd-handle">
                                                Pencapaian Indikator
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="4">
                                            <div class="dd-handle">
                                                Data BPS
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="5">
                                            <div class="dd-handle">
                                                Laporan Indikator
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="6">
                                            <div class="dd-handle">
                                                Manajemen Data
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="7">
                                            <div class="dd-handle">
                                                Upload Data Indikator
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="8">
                                            <div class="dd-handle">
                                                Upload Data APBD
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="9">
                                            <div class="dd-handle">
                                                Manajemen User
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="10">
                                            <div class="dd-handle">
                                                Fitur
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="11">
                                            <div class="dd-handle">
                                                Role
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="12">
                                            <div class="dd-handle">
                                                User
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div><!-- end col -->

                        </div> <!-- end row -->
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div>
            <!-- end Row -->


            <!-- end Row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>
</div>

<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form id="ubah_fitur">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Data Fitur</h4>
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
                                <label for="fitur" class="control-label">Parent Fitur</label>
                                <select class="form-control" id="editfitur" name="editfitur">
                                    <option value="" disabled selected>-- Nothing Selected --</option>
                                    <!-- <option value=""><i>NULL</i></option> -->
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
                    <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>