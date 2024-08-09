<!-- <div class="content-page" style="margin-top: 20px;"> -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container" style="width: 93%;">
            <div class="row">
                <!-- <h4 class="m-t-0 header-title"><b>Responsive example</b></h4>
                <p class="text-muted font-13 m-b-30">
                    Responsive is an extension for DataTables that resolves that problem by optimising the
                    table's layout for different screen sizes through the dynamic insertion and removal of
                    columns from the table.
                </p> -->



                <div class="row">
                    <div class="col-12">
                        <div class="card-box" style="border: 0px;">

                            <ul class="nav nav-tabs tabs-bordered">
                                <li class="active">
                                    <a href="#repositori-b1" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">Repositori</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#grafik-b1" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">Grafik</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="repositori-b1">
                                    <!-- <div class="row" style="background-image: url('<?= base_url() ?>assets/images/innovation.jpg');"> -->
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <ul class="nav nav-tabs tabs-bordered nav-justified">
                                                <li class="active">
                                                    <a href="#home-b2" data-toggle="tab" aria-expanded="true">
                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                        <span class="hidden-xs">General Search</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#profile-b2" data-toggle="tab" aria-expanded="false">
                                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                                        <span class="hidden-xs">Advance Search</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="home-b2">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group search-box">
                                                                <input type="text" id="global_filter" class="form-control product-search global_filter" placeholder="cari dokumen disini...">
                                                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-20">
                                                        <div class="col-12" style="text-align: center;">
                                                            <a href="#" id="RPJMD" data-val="RPJMD" class="DokumRekom"><label class="fa fa-file-o"></label> RPJMD</a> | <a href="#" id="RKPD" data-val="RKPD" class="DokumRekom"><label class="fa fa-file-text-o"></label> RKPD</a> | <a href="#" id="inovasi" data-val="inovasi" class="DokumRekom"><label class="fa fa-info"></label> Inovasi</a> | <a href="#" id="APBD" data-val="APBD" class="DokumRekom"><label class="fa fa-file-excel-o"></label> APBD</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile-b2">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <table style="margin-bottom: 30px; width: 100%; border-spacing: revert; border-collapse: separate;">
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="4" style="padding-bottom: 5px;">
                                                                            <center><b>Cari Berdasarkan</b></center>
                                                                        </td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Nama Dokumen</td>
                                                                        <td align="center" colspan="3"><input type="text" class="column_filter" style="border: 1px solid lightgrey; width: -webkit-fill-available;" data-column="1" id="col1_filter" placeholder="..."></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jenis</td>
                                                                        <td align="center" colspan="3"><input type="text" class="column_filter" style="border: 1px solid lightgrey; width: -webkit-fill-available;" data-column="2" id="col2_filter" placeholder="..."></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tahun</td>
                                                                        <td align="center" colspan="3"><input type="text" class="column_filter" style="border: 1px solid lightgrey; width: -webkit-fill-available;" data-column="3" id="col3_filter" placeholder="..."></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diupload Oleh</td>
                                                                        <td align="center" colspan="3"><input type="text" class="column_filter" style="border: 1px solid lightgrey; width: -webkit-fill-available;" data-column="4" id="col4_filter" placeholder="..."></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row m-t-20">
                                        <button type="button" class="btn btn-teal waves-light waves-effect w-md m-b-5 btnUnduhDok" style="float: right; position: sticky; top: 70px;"><span class="icon" style="margin-right: 5px; color: black;"></span><label class="fa fa-folder"></label> Unduh Folder <span class="badge badge-inverse folderFile"></span></button>
                                        <table id="example" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>
                                                        <center>Nama Dokumen</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis</center>
                                                    </th>
                                                    <th>
                                                        <center>Tahun</center>
                                                    </th>
                                                    <th>
                                                        <center>Diupload Oleh</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot id="footDokumen">
                                                <tr>
                                                    <th></th>
                                                    <th>
                                                        <center>Nama Dokumen</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis</center>
                                                    </th>
                                                    <th>
                                                        <center>Tahun</center>
                                                    </th>
                                                    <th>
                                                        <center>Diupload Oleh</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                                <div class="tab-pane" id="grafik-b1">


                                    <div class="col-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <ul class="nav nav-pills m-b-30 pull-right">
                                                    <li class="active">
                                                        <a href="#navpills-1" data-toggle="tab" aria-expanded="true">Pie Chart</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#navpills-2" data-toggle="tab" aria-expanded="false">Drilldown Column Chart</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content br-n pn">
                                                    <div id="navpills-1" class="tab-pane active">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="container"></div>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="navpills-2" class="tab-pane">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <figure class="highcharts-figure">
                                                                    <div id="container-2"></div>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>
</div>