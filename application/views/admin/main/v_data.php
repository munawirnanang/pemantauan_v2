<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
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
                            <h4 class="m-t-0 header-title m-b-15"><b>List Data API BPS</b></h4>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID API</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i= 1?>
                                <?php foreach($tabel as $t) :?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $t['id_api'] ?></td>
                                        <td><a href="#" class="detail-link" data-id="<?= $t['id_api'] ?>" data-toggle="tab" data-target="#cari-b1"> <?= $t['judul'] ?></a></td>
                                        <td><?= $t['kategori'] ?></td>
                                        <td><?= $t['sub_kategori'] ?></td>
                                    </tr>
                                <?php $i++ ?>
                                <?php endforeach ?>
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
