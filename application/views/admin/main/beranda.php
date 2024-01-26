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
                        <h4 class="page-title">Dashboard 2 </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Zircos</a>
                            </li>
                            <li>
                                <a href="#">Dashboard </a>
                            </li>
                            <li class="active">
                                Dashboard 2
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-primary">
                        <i class="mdi mdi-chart-areaspline widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Statistics</p>
                            <h2><span data-plugin="counterup">34578</span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 30.4k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-warning">
                        <i class="mdi mdi-layers widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">User This Month</p>
                            <h2><span data-plugin="counterup">52410 </span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 40.33k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-danger">
                        <i class="mdi mdi-access-point-network widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Statistics</p>
                            <h2><span data-plugin="counterup">6352</span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 30.4k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-success">
                        <i class="mdi mdi-account-convert widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">User Today</p>
                            <h2><span data-plugin="counterup">895 </span> <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 1250</p>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Total Revenue</h4>

                        <div id="website-stats" style="height: 320px;" class="flot-chart"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Sales Analytics</h4>

                        <div class="pull-right m-b-30">
                            <div id="reportrange" class="form-control">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div id="donut-chart">
                            <div id="donut-chart-container" class="flot-chart" style="height: 240px;">
                            </div>
                        </div>

                        <p class="text-muted m-b-0 m-t-15 font-13 text-overflow">Pie chart is used to see the proprotion of each data groups, making Flot pie chart is pretty simple, in order to make pie chart you have to incldue jquery.flot.pie.js plugin.</p>
                    </div>
                </div>

            </div>
            <!-- end row -->


            <div class="row">

                <div class="col-md-4">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Messages</h4>

                        <div class="inbox-widget slimscroll-alt" style="min-height: 302px;">
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-1.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Chadengle</p>
                                    <p class="inbox-item-text">Hey! there I'm available...</p>
                                    <p class="inbox-item-date">13:40 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-2.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Tomaslau</p>
                                    <p class="inbox-item-text">I've finished it! See you so...</p>
                                    <p class="inbox-item-date">13:34 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-3.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Stillnotdavid</p>
                                    <p class="inbox-item-text">This theme is awesome!</p>
                                    <p class="inbox-item-date">13:17 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-4.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Kurafire</p>
                                    <p class="inbox-item-text">Nice to meet you</p>
                                    <p class="inbox-item-date">12:20 PM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-5.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Shahedk</p>
                                    <p class="inbox-item-text">Hey! there I'm available...</p>
                                    <p class="inbox-item-date">10:15 AM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-6.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Adhamdannaway</p>
                                    <p class="inbox-item-text">This theme is awesome!</p>
                                    <p class="inbox-item-date">9:56 AM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-8.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Arashasghari</p>
                                    <p class="inbox-item-text">Hey! there I'm available...</p>
                                    <p class="inbox-item-date">10:15 AM</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="<?= base_url('assets') ?>/assets/images/users/avatar-9.jpg" class="img-circle" alt=""></div>
                                    <p class="inbox-item-author">Joshaustin</p>
                                    <p class="inbox-item-text">I've finished it! See you so...</p>
                                    <p class="inbox-item-date">9:56 AM</p>
                                </div>
                            </a>
                        </div>

                    </div> <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Recent Users</h4>

                        <div class="table-responsive">
                            <table class="table table table-hover m-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>User Name</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>
                                            <img src="<?= base_url('assets') ?>/assets/images/users/avatar-6.jpg" alt="user" class="thumb-sm img-circle" />
                                        </th>
                                        <td>
                                            <h5 class="m-0">Louis Hansen</h5>
                                            <p class="m-0 text-muted font-13"><small>Web designer</small></p>
                                        </td>
                                        <td>+12 3456 789</td>
                                        <td>USA</td>
                                        <td>07/08/2016</td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <span class="avatar-sm-box bg-primary">C</span>
                                        </th>
                                        <td>
                                            <h5 class="m-0">Craig Hause</h5>
                                            <p class="m-0 text-muted font-13"><small>Programmer</small></p>
                                        </td>
                                        <td>+89 345 6789</td>
                                        <td>Canada</td>
                                        <td>29/07/2016</td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <img src="<?= base_url('assets') ?>/assets/images/users/avatar-7.jpg" alt="user" class="thumb-sm img-circle" />
                                        </th>
                                        <td>
                                            <h5 class="m-0">Edward Grimes</h5>
                                            <p class="m-0 text-muted font-13"><small>Founder</small></p>
                                        </td>
                                        <td>+12 29856 256</td>
                                        <td>Brazil</td>
                                        <td>22/07/2016</td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <span class="avatar-sm-box bg-pink">B</span>
                                        </th>
                                        <td>
                                            <h5 class="m-0">Bret Weaver</h5>
                                            <p class="m-0 text-muted font-13"><small>Web designer</small></p>
                                        </td>
                                        <td>+00 567 890</td>
                                        <td>USA</td>
                                        <td>20/07/2016</td>
                                    </tr>

                                    <tr>
                                        <th>
                                            <img src="<?= base_url('assets') ?>/assets/images/users/avatar-8.jpg" alt="user" class="thumb-sm img-circle" />
                                        </th>
                                        <td>
                                            <h5 class="m-0">Mark</h5>
                                            <p class="m-0 text-muted font-13"><small>Web design</small></p>
                                        </td>
                                        <td>+91 123 456</td>
                                        <td>India</td>
                                        <td>07/07/2016</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div> <!-- table-responsive -->
                    </div> <!-- end card -->
                </div>
                <!-- end col -->

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