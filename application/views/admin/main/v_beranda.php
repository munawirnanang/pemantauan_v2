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
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="indikator_makro">Indikator Makro</p>
                            <h2><span data-plugin="counterup">34578</span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 30.4k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-warning">
                        <i class="mdi mdi-layers widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="apbd">APBD</p>
                            <h2><span data-plugin="counterup">52410 </span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 40.33k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-danger">
                        <i class="mdi mdi-access-point-network widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="repositori_dokumen">Repositori Dokumen</p>
                            <h2><span data-plugin="counterup">6352</span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 30.4k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-success">
                        <i class="mdi mdi-account-convert widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="innovation_hub">Innovation Hub</p>
                            <h2><span data-plugin="counterup">895 </span> <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 1250</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-danger">
                        <i class="mdi mdi-access-point-network widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="bps">BPS</p>
                            <h2><span data-plugin="counterup">6352</span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                            <p class="text-muted m-0"><b>Last:</b> 30.4k</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-6">
                    <div class="card-box widget-box-two widget-two-success">
                        <i class="mdi mdi-account-convert widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="SDGs">SDGs</p>
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
                        <h4 class="header-title m-t-0 m-b-30">Indikator Makro</h4>

                        <div id="website-stats" style="height: 320px;" class="flot-chart"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">APBD</h4>

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

                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Repositori Dokumen</h4>

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
                <div class="col-lg-6">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            Sunburst charts are used to visualize hierarchical data in a
                            circular shape. The inner elements are parent nodes, with
                            child nodes distributed on the outer rings. Click on a parent
                            node to drill down and inspect the tree in more detail.
                        </p>
                    </figure>
                </div>
                

            </div>
            <!-- end row -->


            <div class="row">

                <div class="col-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tabel</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills m-b-30 pull-left">
                                <li class="active">
                                    <a href="#navpills-11" data-toggle="tab" aria-expanded="true">Tabel Indikator</a>
                                </li>
                                <li class="">
                                    <a href="#navpills-21" data-toggle="tab" aria-expanded="false">Tabel APBD</a>
                                </li>
                                <li class="">
                                    <a href="#navpills-31" data-toggle="tab" aria-expanded="false">Tabel Dokumen</a>
                                </li>
                                <li class="">
                                    <a href="#navpills-41" data-toggle="tab" aria-expanded="false">Tabel Inovasi</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="navpills-11" class="tab-pane active">
                                    <div class="row" style="margin-top: 50px; margin-left: 10px; margin-right: 10px;">
                                        <div class="col-12">
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
                                        </div>
                                    </div>
                                </div>
                                <div id="navpills-21" class="tab-pane">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="navpills-31" class="tab-pane">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="navpills-41" class="tab-pane">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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