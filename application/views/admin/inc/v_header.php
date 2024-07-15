<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/assets/images/favicon.ico">
    <!-- App title -->
    <title>Dashboard Pemantauan - Direktorat PEPPD</title>

    <!-- date range picker -->
    <link href="<?= base_url('assets') ?>/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Jquery filer css -->
    <link href="<?= base_url('assets') ?>/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="<?= base_url('assets') ?>/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- Nestable css -->
    <link href="<?= base_url('assets') ?>/plugins/nestable/jquery.nestable.css" rel="stylesheet" />

    <!-- App css -->
    <link href="<?= base_url('assets') ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/spinner.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/switchery/switchery.min.css">

    <!-- bootstrap-select -->
    <link href="<?= base_url('assets') ?>/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />

    <link href="<?= base_url('assets') ?>/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet"> -->
    <link href="<?= base_url('assets') ?>/plugins/sweetalert2/src/sweetalert2.scss" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/plugins/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />

    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>

    <!-- Sweet Alert -->
    <!-- <link href="<?= base_url('assets') ?>/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css"> -->


    <!-- Notification css (Toastr) -->
    <link href="<?= base_url('assets') ?>/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <style>
        .dataTables_info {
            position: absolute;
        }
    </style>

    <style>
        .selectcustom>button {
            border-radius: 25px;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 95%;
            height: 95%;
        }
    </style>

    <style>
        #currpass {
            display: flex;
            border: 0.5px solid lightgrey;
            border-radius: 5px 5px 5px 5px;
        }

        #currpass:hover {
            border: 1px solid black;
        }

        #newpass {
            display: flex;
            border: 0.5px solid lightgrey;
            border-radius: 5px 5px 5px 5px;
        }

        #newpass:hover {
            border: 1px solid black;
        }

        #repnewpass {
            display: flex;
            border: 0.5px solid lightgrey;
            border-radius: 5px 5px 5px 5px;
        }

        #repnewpass:hover {
            border: 1px solid black;
        }
    </style>

    <style>
        .dtr-data {
            text-wrap: wrap;
        }

        #footDokumen>tr>.dt-control>.footer {
            display: contents;
        }

        #footDokumen>tr>th>.footerAksi {
            display: contents;
        }
    </style>

    <style>
        #example {
            width: 100%;
            table-layout: fixed;
        }

        .dt-control {
            border-right: transparent !important;
            padding-top: 11px !important;
            /* padding-right: 0px !important; */
        }
    </style>

    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <script src="<?= base_url('assets') ?>/assets/js/modernizr.min.js"></script>

</head>

<body class="fixed-left">
    <div id="loading-animation" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <div class="loader"></div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">