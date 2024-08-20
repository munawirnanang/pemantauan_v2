<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->


<div class="content-page">
    <!-- Start content -->
    <div class="content" style="margin-top: 0px;">
        <div class="container">
            <div class="row" style="position: fixed; z-index: 15; width: 80%; background-color: white; padding-top: 5px;">
                <form id="apbdform" class="form">
                    <div class="col-12" style="display: flex; align-items: self-end; justify-content: space-between; margin-left: 60px; margin-right: 60px;">
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Daerah <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Daerah dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="wilayah" name="wilayah[]" multiple="multiple" data-actions-box="false" data-live-search="true" data-dropup-auto="false" data-size="5" data-selected-text-format="count > 3" data-width="250px">
                                <?php foreach($wilayah as $w) :?>
                                    <option value="<?= $w['id'] ?>"><?= $w['nama_wilayah'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Item <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Item dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="item" name="item[]" multiple="multiple" data-actions-box="true"  data-live-search="true" data-dropup-auto="false" data-size="5" data-selected-text-format="count > 3" data-max-options="5" data-width="250px">
                                <?php foreach($list_apbd as $w) :?>
                                    <option value="<?= $w['kode'] ?>"><?= $w['kode'].'. '.$w['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Tahun <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Tahun dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="tahun" name="tahun[]" multiple="multiple" data-live-search="true" data-dropup-auto="false" data-size="8" data-selected-text-format="count > 6" data-max-options="5" data-width="250px">
                            <?php foreach($tahun as $t) :?>
                                    <option value="<?= $t['tahun'] ?>"><?= $t['tahun'] ?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;"></p>
                            <button class="btn btn-danger btn-bordered waves-effect w-md waves-light m-b-5 btn-submit" style="border-radius: 25px;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- end row -->
            <div class="row" style="margin-left: 25px; margin-right: 25px; margin-top: 109px;">
                <div class="col-12">
                    <ul class="nav nav-tabs tabs-bordered" style="position: fixed; z-index: 14; width: 75%; background-color: white;">
                        <li class="active">
                            <a href="#overview-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Overview</span>
                            </a>
                        </li>
                        <li class="hide-tab">
                            <a href="#sunburst-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">Sunburst Chart</span>
                            </a>
                        </li>
                        <li class="hide-tab">
                            <a href="#bar-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                <span class="hidden-xs">Bar Chart</span>
                            </a>
                        </li>
                        <li class="hide-tab">
                            <a href="#tabel-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">Tabel</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="padding-top: 60px;">
                        <div class="tab-pane active" id="overview-b1">
                            <div class="row" id="apbd-overview">
                              
                            </div>
                        </div>

                        <div class="tab-pane" id="sunburst-b1">
                            
                        </div>
                        <div class="tab-pane" id="bar-b1">
                            
                        </div>
                        <div class="tab-pane" id="tabel-b1"> 
                            aaaaaaa
                        </div>
                    </div>
                </div> 
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>

</div>
<!-- ============================================================== -->
<!-- End rightside content here -->
<!-- ============================================================== -->