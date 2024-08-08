<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="<?=base_url('upload_indikator')?>">Upload Indikator</a>
                            </li>
                            <li class="active">
                                Upload Data <?= $indikator['nama_indikator']?>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>           

            <div class="row m-t-15">
                <div class="col-xs-12">
                    <div class="card-box">

                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <h4 class="header-title m-t-0">Upload Data indikator</h4>
                                <p class="text-muted font-13 m-b-30">
                                    Silahkan unduh template indikator, lalu upload untuk memperbaharui data indikator
                                </p>
                                <div class="grid-container pull-right">
                                    <a href="<?= base_url('export_template/').$id_indikator?>" type="button" class="btn btn-success waves-effect waves-light m-b-15" ><i class="fa fa-download"></i> Download Template indikator</a>
                                </div>

                                <div class="p-20">
                                    <div class="form-group clearfix">
                                        <div class="col-sm-12 padding-left-0 padding-right-0">
                                            <form id="uploadForm" action="<?php echo base_url('input_upload'); ?>" method="post" enctype="multipart/form-data">
                                                <input type="file" name="files" id="filer_input1">
                                                <input type="hidden" name="id_indikator" id="id_indikator" value="<?=$id_indikator?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <center>
                                    <div class="alert alert-success" role="alert">
                                            <strong>Jumlah Wilayah :</strong> <?= $count_data['jumlah_wilayah']?>
                                        </div>
                                </center>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <div class="alert alert-info" role="alert">
                                            <strong>Tahun :</strong> <?= $count_data['tahunawal']?> - <?=$count_data['tahunakhir']?>
                                        </div>
                                </center>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <div class="alert alert-success" role="alert">
                                            <strong>Jumlah Data :</strong> <?= $count_data['jumlah_data'] ?>
                                        </div>
                                </center>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <h4 class="header-title m-t-0">History Update Indikator <?= $indikator['nama_indikator']?></h4>
                                <table id="datatable-responsive" class="table table-striped table-bordered table-colored table-success">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>Nama File</center>
                                            </th>
                                            <th>
                                                <center>Size</center>
                                            </th>
                                            <th>
                                                <center>Diupload</center>
                                            </th>
                                            <th>
                                                <center>Diupload oleh</center>
                                            </th>
                                            <th>
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="indikator-table-body">
                                    <?php
                                        $i = 1;
                                        foreach ($file as $u) :
                                        ?>
                                            <tr>
                                                <td><?= $u['file_name'] ?></td>
                                                <td><?= $u['file_size'] ?> KB</td>
                                                <td><?= $u['up_dt'] ?></td>
                                                <td><?= $u['up_by'] ?></td>
                                                <td>    
                                                    <a href="<?=base_url('uploads/').$u['file']?>" class="btn btn-icon btn-rounded waves-effect waves-light btn-success m-b-5"><i class="fa fa-download"></i></a>
                                                    <button class="btn btn-icon btn-rounded waves-effect waves-light btn-danger m-b-5" action="hapus_upload" name="hapus" id="hapus" nama-hapus="<?=$u['file_name']?>" id-hapus="<?=$u['id']?>"><i class="fa fa-trash"></i></button>
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
                        <!-- end row -->


                    </div>
                </div><!-- end col-->

            </div>
            <!-- end row -->


        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>

</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->