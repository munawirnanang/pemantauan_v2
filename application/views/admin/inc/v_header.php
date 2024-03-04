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

    <!-- App css -->
    <link href="<?= base_url('assets') ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/assets/css/responsive.css" rel="stylesheet" type="text/css" />
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
        .selectcustom>button {
            border-radius: 25px;
        }
    </style>

    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <script src="<?= base_url('assets') ?>/assets/js/modernizr.min.js"></script>

</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">