<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->

<div class="content-page">
    <!-- Start content -->
    <div class="content" style="margin-top: 0px;">
        <div class="container">
            <div class="row" style="position: fixed; z-index: 15; width: 80%; background-color: white; padding-top: 5px;">
                <form class="form">
                    <div class="col-12" style="display: flex; align-items: self-end; justify-content: space-between; margin-left: 60px; margin-right: 60px;">
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Daerah <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Daerah dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="selectregion" name="region[]" multiple="multiple" data-actions-box="true" data-live-search="true" data-dropup-auto="false" data-size="5" data-selected-text-format="count > 3" data-width="250px">
                                <?php foreach($wilayah as $w) :?>
                                    <option value="<?= $w['id'] ?>"><?= $w['nama_wilayah'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Indikator <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Indikator dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="selectindicator" name="indicator[]" multiple="multiple" data-live-search="true" data-dropup-auto="false" data-size="5" data-selected-text-format="count > 3" data-max-options="5" data-width="250px">
                                <?php foreach($indikator as $i) :?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nama_indikator'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;">
                                Pilih Tahun <span class="label label-default" style="background-color: rgba(108, 117, 125, 0.7); font-size: 9px;">Tahun dapat di pilih lebih dari satu</span>
                            </p>
                            <select class="selectpicker selectcustom form-control" id="selectyear" name="year[]" multiple="multiple" data-live-search="true" data-dropup-auto="false" data-size="8" data-selected-text-format="count > 6" data-max-options="5" data-width="250px">
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <p class="text-muted m-t-30 mb-2" style="justify-self: center; font-size: 10px;"></p>
                            <button type="button" class="btn btn-danger btn-bordered waves-effect w-md waves-light m-b-5" style="border-radius: 25px;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- end row -->
            <div class="row" style="margin-left: 25px; margin-right: 25px; margin-top: 109px;">
                <div class="col-12">
                    <ul class="nav nav-tabs tabs-bordered" style="position: fixed; z-index: 14; width: 75%; background-color: white;">
                        <li class="">
                            <a href="#home-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Overview</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#profile-b1" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">Grafik</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#messages-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                <span class="hidden-xs">Tabel</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#settings-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                <span class="hidden-xs">Maps</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="padding-top: 60px;">
                        <div class="tab-pane" id="home-b1">
                            <div class="card-box table-responsive">
                                <h4 class="m-t-0 header-title m-b-15"><b>API</b></h4>
                                <table id="datatable" class="table table-striped table-bordered">
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane active" id="profile-b1">
                            <div class="col-lg-6">
                                <div class="panel panel-default panel-border" style="height: 300px; border-radius: 30px; border: 1px solid #ccc;">
                                    <!-- <div class="panel-heading" style="border-radius: 30px 30px 0 0;">
                                        <h3 class="panel-title">Panel Default</h3>
                                    </div> -->
                                    <div class="panel-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default panel-border" style="height: 300px; border-radius: 30px; border: 1px solid #ccc;">
                                    <!-- <div class="panel-heading" style="border-radius: 30px 30px 0 0;">
                                        <h3 class="panel-title">Panel Default</h3>
                                    </div> -->
                                    <div class="panel-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default panel-border" style="height: 300px; border-radius: 30px; border: 1px solid #ccc;">
                                    <!-- <div class="panel-heading" style="border-radius: 30px 30px 0 0;">
                                        <h3 class="panel-title">Panel Default</h3>
                                    </div> -->
                                    <div class="panel-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default panel-border" style="height: 300px; border-radius: 30px; border: 1px solid #ccc;">
                                    <!-- <div class="panel-heading" style="border-radius: 30px 30px 0 0;">
                                        <h3 class="panel-title">Panel Default</h3>
                                    </div> -->
                                    <div class="panel-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default panel-border" style="height: 300px; border-radius: 30px; border: 1px solid #ccc;">
                                    <!-- <div class="panel-heading" style="border-radius: 30px 30px 0 0;">
                                        <h3 class="panel-title">Panel Default</h3>
                                    </div> -->
                                    <div class="panel-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages-b1">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div>
                        <div class="tab-pane" id="settings-b1">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        </div>
                    </div>
                </div> <!-- end col -->
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