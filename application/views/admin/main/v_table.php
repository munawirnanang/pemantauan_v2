<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->


<div class="content-page">
    <!-- Start content -->
    <div class="content" style="margin-top: 0px;">
        <div class="container">
            <div class="row" style="position: fixed; z-index: 15; width: 80%; background-color: white; padding-top: 5px;">
                <form id="indikatorform" class="form">
                    <div class="col-12" style="display: flex; align-items: self-end; justify-content: space-between; margin-left: 60px; margin-right: 60px;">
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Daerah <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Daerah dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="wilayah" name="wilayah[]" multiple="multiple" data-actions-box="true" data-live-search="true" data-dropup-auto="false" data-size="5" data-selected-text-format="count > 3" data-width="250px">
                                <?php foreach($wilayah as $w) :?>
                                    <option value="<?= $w['id'] ?>"><?= $w['nama_wilayah'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Indikator <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Indikator dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="indikator" name="indikator[]" multiple="multiple" data-live-search="true" data-dropup-auto="false" data-size="5" data-selected-text-format="count > 3" data-max-options="5" data-width="250px">
                                <?php foreach($indikator as $i) :?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nama_indikator'] ?></option>
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
                            <a href="#home-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Overview</span>
                            </a>
                        </li>
                        <li class="hide-tab">
                            <a href="#grafik-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">Grafik</span>
                            </a>
                        </li>
                        <li class="hide-tab">
                            <a href="#tabel-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                <span class="hidden-xs">Tabel</span>
                            </a>
                        </li>
                        <li class="hide-tab">
                            <a href="#maps-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">Maps</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="padding-top: 60px;">
                        <div class="tab-pane active" id="home-b1" onclick="resizeMap()">
                            <div class="row" id="highlightoverview">
                                <?= $html_card?>
                            </div>
                        </div>

                        <div class="tab-pane" id="grafik-b1">
                            
                        </div>
                        <div class="tab-pane" id="tabel-b1">
                            <div class="card-box table-responsive">
                                <table id="tabel_indikator" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Indikator 1</td>
                                            <td>Indikator 2</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="maps-b1" onclick="resizeMap()"> 
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="panel panel-default panel-border">
                                        <div class="panel-body" style="height: 530px">
                                            <div class="text-center h5" id="judul_indikator">-</div>
                                            <hr>
                                            <div class="row m-t-0" id="tahunoption">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-block btn-primary waves-effect waves-light btn-xs m-b-5" name="tahun" id="tahun1">-</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-block btn-default waves-effect waves-light btn-xs m-b-5" name="tahun" id="tahun2">-</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-block btn-default waves-effect waves-light btn-xs m-b-5" name="tahun" id="tahun3">-</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-block btn-default waves-effect waves-light btn-xs m-b-5" name="tahun" id="tahun4">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr id="divider1">
                                            <div class="row m-t-0" id="alloption">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-block btn-primary waves-effect waves-light btn-xs m-b-5" name="indktr" id="indikator1">-</button>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-block btn-default waves-effect waves-light btn-xs m-b-5" name="indktr" id="indikator2">-</button>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-block btn-default waves-effect waves-light btn-xs m-b-5" name="indktr" id="indikator3">-</button>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-block btn-default waves-effect waves-light btn-xs m-b-5" name="indktr" id="indikator4">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr id="divider">
                                            <div class="row" id="idslider">
                                                <label id="selecttahun"></label>
                                                <input id="slider" type="range" min="0" max="4" step="1" value="0">
                                                <hr>
                                            </div>
                                            <div class="text" id="description">

                                            </div>                                              
                                            <hr>
                                            <div class="row">
                                            <div  id="satuan" style="font-size: 14px;"></div>
                                            <p style="font-size: 14px;">Keterangan :</p>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div id="warna1" style="height: 15px; width: 15px; background-color: #ff8989; margin-right: 15px;"></div>
                                                    </td>
                                                    <td>
                                                        <div id="keterangan1" style="font-size: 12px;"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="warna2" style="height: 15px; width: 15px; background-color: #a9ff68; margin-right: 15px;"></div>
                                                    </td>
                                                    <td>
                                                        <div id="keterangan2" style="font-size: 12px;"></div>
                                                    </td>
                                                </tr>
                                            </table>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="panel panel-default panel-border">
                                        <div class="panel-body" style="height: 530px">
                                            <div id="map">
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
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