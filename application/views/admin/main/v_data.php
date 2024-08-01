<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        
                        <h4 class="page-title"><?=$indikator?></h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="<?=base_url('data_bps/').$uri?>">Data Badan Pusat Statistik</a>
                            </li>
                            <li class="active">
                                <?=$indikator?>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>                          
            <div class="row m-t-15">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs tabs-bordered">
                        <li class="active">
                            <a href="#data-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-database"></i></span>
                                <span class="hidden-xs">List Data</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#cari-b1" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-search"></i></span>
                                <span class="hidden-xs">Data</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="data-b1">
                            <h4 class="m-t-0 header-title m-b-15"><b>List Data</b></h4>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($tabel as $t) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><a href="<?= base_url() ?>detail_data?id=<?= $t['var_id'] ?>&id_kategori=<?=$segment?>&uri=<?= $uri ?>" class="detail-link" data-toggle="tab" data-target="#cari-b1"><?= $t['title'] ?></a></td>
                                            <td><?= $t['sub_name'] ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="cari-b1">

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>

</div>
<script>
   
</script>


<!-- ============================================================== -->
<!-- End rightside content here -->
<!-- ============================================================== -->
