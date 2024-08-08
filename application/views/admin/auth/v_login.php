<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/') ?>images/favicon_bappenas_2023.ico">
    <!-- App title -->
    <title>Dashboard Pemantauan</title>

    <!-- App css -->
    <link href="<?= base_url('assets/') ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="<?= base_url('assets/') ?>assets/js/modernizr.min.js"></script>

</head>


<body style="background-color: #C8EEFB;">

    <!-- HOME -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="background-color: white; border: 1px solid white; border-radius: 25px; box-shadow: 0px 0px 20px lightgrey ;margin: auto; top: 10vh; position: relative; height: 450px; width: 870px;">
                        <div class="card-body">
                            <div class="row" style="display: flex;">
                                <div class="col-7" style="border-radius: 20px 0 0 20px; height: 450px; width: 70rem; margin-left: 10px; background-image: url('<?= base_url('assets') ?>/images/banner-pemantauan.png'); background-size: 700px 480px;">
                                </div>
                                <div class="col-5" style="border-radius: 0 20px 20px 0; height: 450px; width: 30rem; margin-right: 10px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card" style="background-image: linear-gradient(to left, #DF0241 30%, #0017ba 100%); width: 90%; margin: auto; margin-top: 20px; margin-bottom: 10px; padding: 0.5px; border-radius: 10px;">
                                                <div class="card-body">
                                                    <h5 style="font-weight: bolder; color: white; text-align: center;">DASHBOARD PEMANTAUAN</h5>
                                                </div>

                                            </div>
                                            <p style="margin: 0px 20px; 20px 0px; color: red;">
                                                <?= $this->session->flashdata('message'); ?>
                                            </p>
                                            <form action="<?= base_url('login'); ?>" method="POST">
                                                <div class="form-group" style="margin: 20px; margin-top: 0px; margin-bottom: 0px;">
                                                    <label for="userName"><sub>User Name<span class="text-danger">*</span></sub></label>
                                                    <input type="text" name="userid" id="userid" required parsley-trigger="change" placeholder="Enter user name" class="form-control" id="userName">
                                                    <sub style="color: red;"><?php echo form_error('userid'); ?></sub>
                                                </div>
                                                <div class="form-group" style="margin: 20px; margin-top: 0px;">
                                                    <label for="pass1"><sub>Password<span class="text-danger">*</span></sub></label>
                                                    <input type="password" name="password" id="password" required placeholder="Password" class="form-control">
                                                    <sub style="color: red;"><?php echo form_error('password'); ?></sub>
                                                </div>
                                                <div class="form-group" style="margin: 20px; margin-top: 0px;">
                                                    <p style="text-align: center;"><?php echo $image; ?></p>
                                                    <label for="pass1"><sub>Captcha<span class="text-danger">*</span></sub></label>
                                                    <input class="form-control" type="text" name="captcha" id="captcha" required>
                                                    <sub style="color: red;"><?php echo form_error('captcha'); ?></sub>
                                                </div>
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <div class="form-group" style="margin: 20px; margin-top: 0px;">
                                                    <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5" style="border-radius: 0px; width: 100%;">LOGIN</button>
                                                    <!-- <a style="float: left;">Sign Up</a> -->
                                                    <a href="<?= base_url('forget_pass'); ?>" style="float: right;">Forget Password?</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="<?= base_url('assets/') ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/detect.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/fastclick.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/waves.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url('assets/') ?>assets/js/jquery.core.js"></script>
    <script src="<?= base_url('assets/') ?>assets/js/jquery.app.js"></script>

</body>

</html>