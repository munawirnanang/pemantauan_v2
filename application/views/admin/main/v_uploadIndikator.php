<div class="content-page" style="margin-top: 20px;">
    <!-- Start content -->
    <div class="content">
        <div class="container" style="width: 93%;">

            <div class="row">    
                <div class="row">
                    <div class="col-md-7">
                        <div class="grid-container">
                            <h4 class="m-t-0 header-title m-b-15"><b>Manajemen Upload Indikator</b></h4>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="grid-container pull-right">
                            <!-- <button type="button" class="btn btn-success waves-effect waves-light m-b-15 btn-refresh-all"><i class="fa fa-refresh"></i> Update Semua Indikator</button> -->
                            <button type="button" class="btn btn-primary waves-effect waves-light m-b-15"  data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus-square"></i> Tambah Indikator</button>
                        </div>
                    </div>
                </div>
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <form action="<?= base_url('tambah_indikator2') ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Tambah Indikator</h4>
                                </div>
                                <div class="modal-body ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="id" class="control-label">ID</label>
                                                <input type="text" class="form-control" id="id" name="id" placeholder="1">
                                                <?= form_error('id', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="group_id" class="control-label">Group ID</label>
                                                <input type="text" class="form-control" group_id="group_id" name="group_id" placeholder="1">
                                                <?= form_error('group_id', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama_indikator" class="control-label">Nama Indikator</label>
                                                <input type="text" class="form-control" id="nama_indikator" name="nama_indikator" placeholder="Laju Pertumbuhan Ekonomi">
                                                <?= form_error('nama_indikator', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama_tabel" class="control-label">Nama tabel</label>
                                                <input type="text" class="form-control" id="nama_tabel" name="nama_tabel" placeholder="ind1_pertm_ekonomi">
                                                <?= form_error('nama_tabel', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenis" class="control-label">Jenis</label>
                                                <select name="jenis" id="jenis" class="form-control">
                                                    <option value="positif">Positif</option>
                                                    <option value="negatif">Negatif</option>
	                                            </select>
                                                <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="chart" class="control-label">Chart</label>
                                                <select name="chart" id="chart" class="form-control">
                                                    <option value="line">Line</option>
                                                    <option value="column">Column/Bar</option>
	                                            </select>
                                                <?= form_error('chart', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="link" class="control-label">Link</label>
                                                <input type="text" class="form-control" id="link" name="link" placeholder="Link">
                                                <?= form_error('link', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="satuan" class="control-label">Satuan</label>
                                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
                                                <?= form_error('satuan', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="urutan" class="control-label">Urutan</label>
                                                <input type="text" class="form-control" id="urutan" name="urutan" placeholder="urutan">
                                                <?= form_error('urutan', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ppd" class="control-label">ppd</label>
                                                <input type="text" class="form-control" id="ppd" name="ppd" placeholder="ppd">
                                                <?= form_error('ppd', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deskripsi" class="control-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                                                <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>') ?>
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
                <div class="flash-gagal" data-flashgagal="<?= $this->session->flashdata('flashgagal') ?>"></div>

                <table id="datatable-indikator" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <center>ID</center>
                            </th>
                            <th>
                                <center>Nama Indikator</center>
                            </th>
                            <th>
                                <center>Nama Tabel</center>
                            </th>
                            <th>
                                <center>Jenis</center>
                            </th>
                            <th>
                                <center>Chart</center>
                            </th>
                            <th>
                                <center>Satuan</center>
                            </th>
                            <th>
                                <center>Jumlah Data</center>
                            </th>
                            <th>
                                <center>Aksi</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        foreach ($indikator as $u) :
                            $constraint=0;
                            if($u['jumlah_data']==0){
                                $constraint=1;
                            }
                        ?>
                            <tr>
                                <!-- <td><?= $i ?></td> -->
                                <td><?= $u['id'] ?></td>
                                <td><a href="<?= base_url('upload/').$u['id'] ?>"><?= $u['nama_indikator'] ?></a></td>
                                <td><?= $u['nama_tabel'] ?></td>
                                <td><?= $u['jenis'] ?></td>
                                <td><?= $u['chart'] ?></td>
                                <td><?= $u['satuan'] ?></td>
                                <td>
                                    <span class="label label-default">Wilayah: <?= $u['jumlah_wilayah'] ?></span>
                                    <!-- <span class="label label-teal">Tahun: <?= $u['jumlah_tahun'] ?></span> -->
                                    <span class="label label-teal">Tahun: <?= $u['tahunawal'] ?>-<?= $u['tahunakhir'] ?></span>
                                    <span class="label label-success">Total: <?= $u['jumlah_data'] ?></span>
                                </td>
                                <td>    
                                    <button class="btn btn-icon btn-rounded waves-effect waves-light btn-info m-b-5 undo-btn"  data-api="<?= $u['id'] ?>" data-nama="<?= $u['nama_indikator']?>"><i class="fa fa-undo"></i></button>
                                    <button class="btn btn-icon btn-rounded waves-effect waves-light btn-warning m-b-5 edit-btn" id="edit"  data-toggle="modal" data-constraint="<?= $constraint ?>" data-id="<?= $u['id']?>" data-api="<?= $u['id_api']?>" data-turvar="<?= $u['id_turvar']?>" data-group="<?= $u['group_id']?>" data-nama="<?= $u['nama_indikator']?>" data-tabel="<?= $u['nama_tabel']?>" data-jenis="<?= $u['jenis']?>" data-chart="<?= $u['chart']?>" data-link="<?= $u['link']?>" data-satuan="<?= $u['satuan']?>" data-urutan="<?= $u['urutan']?>" data-ppd="<?= $u['ppd']?>" data-deskripsi="<?= $u['deskripsi']?>" data-target="#modal-edit"><i class="fa fa-pencil-square-o"></i></button>
                                    <button class="btn btn-icon btn-rounded waves-effect waves-light btn-danger m-b-5" action="hapus_indikator" name="hapus" id="hapus" name="hapus" nama-hapus="<?= $u['nama_indikator']?>" id-hapus="<?= $u['id']?>"><i class="fa fa-trash"></i></button>
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
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Data Indikator</h4>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id" class="control-label">ID</label>
                                <input type="text" class="form-control" id="id_edit" name="id_edit" placeholder="1" >
                                <div id="keterangan"></div>
                                <?= form_error('id_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="group_id" class="control-label">Group ID</label>
                                <input type="text" class="form-control" id="group_id_edit" name="group_id_edit" >
                                <?= form_error('group_id_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_indikator" class="control-label">Nama Indikator</label>
                                <input type="text" class="form-control" id="nama_indikator_edit" name="nama_indikator_edit" >
                                <?= form_error('nama_indikator_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_tabel" class="control-label">Nama tabel</label>
                                <input type="text" class="form-control" id="nama_tabel_edit" name="nama_tabel_edit" >
                                <?= form_error('nama_tabel_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis" class="control-label">Jenis</label>
                                <select name="jenis_edit" id="jenis_edit" class="form-control">
                                    <option value="positif">Positif</option>
                                    <option value="negatif">Negatif</option>
                                </select>
                                <?= form_error('jenis_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="chart" class="control-label">Chart</label>
                                <select name="chart_edit" id="chart_edit" class="form-control">
                                    <option value="line">Line</option>
                                    <option value="column">Column/Bar</option>
                                </select>
                                <?= form_error('chart_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="link" class="control-label">Link</label>
                                <input type="text" class="form-control" id="link_edit" name="link_edit">
                                <?= form_error('link_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="satuan" class="control-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan_edit" name="satuan_edit">
                                <?= form_error('satuan_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="urutan" class="control-label">Urutan</label>
                                <input type="text" class="form-control" id="urutan_edit" name="urutan_edit">
                                <?= form_error('urutan_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ppd" class="control-label">ppd</label>
                                <input type="text" class="form-control" id="ppd_edit" name="ppd_edit" >
                                <?= form_error('ppd_edit', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi" class="control-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_edit" name="deskripsi_edit" rows="3"></textarea>
                                <?= form_error('deskripsi_edit', '<small class="text-danger pl-3">', '</small>') ?>
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