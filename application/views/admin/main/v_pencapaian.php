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
                        <h4 class="page-title"><?php echo $menu ?> </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="<?php echo base_url() . $menu ?>"><?php echo $menu ?></a>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-11 ">
                    <div class="col-md-4">
                        <div class="demo-box">
                            <p class="text-muted m-b-15 font-13">
                                Pilih Daerah
                            </p>
                            <select class="selectpicker">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="demo-box">
                            <p class="text-muted m-b-15 font-13">
                                Pilih Indikator
                            </p>
                            <select class="selectpicker">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="demo-box">
                            <p class="text-muted m-b-15 font-13">
                                Pilih Tahun
                            </p>
                            <select class="selectpicker">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1 ">
                        <div class="demo-box text-right">
                            Submit
                        </div>
                        <button type="button" class="btn-sm btn-success waves-effect w-md waves-light m-t-5 btn-block">Submit</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 m-t-50">
                    <ul class="nav nav-tabs navtab-bg nav-justified">
                        <li class="active">
                            <a href="#home1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Tabel</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#messages1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                <span class="hidden-xs">Grafik</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#settings1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">GIS</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home1">
                            <div class="container-fluid m-t-30">
                                <div class="text-center">
                                    <img src="<?= base_url() ?>assets/assets/images/searching.png" alt="Searching" width="435">
                                    <h4>Pilih Daerah, Indikator, dan Tahun pada Form diatas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages1">
                            <div class="container-fluid m-t-30">
                                <div class="text-center">
                                    <img src="<?= base_url() ?>assets/assets/images/searching.png" alt="Searching" width="435">
                                    <h4>Pilih Daerah, Indikator, dan Tahun pada Form diatas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings1">
                            <div class="container-fluid m-t-30">
                                <div class="text-center">
                                    <img src="<?= base_url() ?>assets/assets/images/searching.png" alt="Searching" width="435">
                                    <h4>Pilih Daerah, Indikator, dan Tahun pada Form diatas</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>

</div>

<!-- ============================================================== -->
<!-- End rightside content here -->
<!-- ============================================================== -->