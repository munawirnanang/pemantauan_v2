<!-- ============================================================== -->
<!-- Start Leftside content here -->
<!-- ============================================================== -->

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>

                <li class="has_sub" style="background-color: #191e27;">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i><img src="<?= base_url('assets') ?>/images/img-profil.jpg" alt="user-img" class="img-circle user-img" width="20" height="20"></i>
                        <span id="leftSideNama"> </span> <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a class="edit-btn-profil" style="cursor: pointer;" data-toggle="modal" data-target="#modal-profil">Profil</a></li>
                        <li><a class="edit-password" style="cursor: pointer;" data-toggle="modal" data-target="#modal-password">Change Password</a></li>
                        <li><a href="<?= base_url('logout'); ?>">Logout</a></li>
                        </a>
                    </ul>
                </li>

                <li class="menu-title">Navigasi</li>

                <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                    <?php if ($fitur == 'Beranda') { ?>
                        <li>
                            <a href="<?= base_url('beranda'); ?>" class="waves-effect"><i class="fa fa-dashboard"></i><span> Beranda </span></a>
                        </li>
                    <?php break;
                    } ?>
                <?php } ?>

                <li class="has_sub">
                    <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                        <?php if (($fitur == 'Pencapaian Indikator') || ($fitur == 'Data BPS') || ($fitur == 'Laporan Indikator')) { ?>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart-o"></i> <span> Indikator Makro </span> <span class="menu-arrow"></span></a>
                        <?php break;
                        } ?>
                    <?php } ?>
                    <ul class="list-unstyled">
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if ($fitur == 'Pencapaian Indikator') { ?>
                                <li><a href="<?= base_url('indikator'); ?>">Pencapaian Indikator</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if ($fitur == 'Data BPS') { ?>
                                <li><a href="<?= base_url('data_bps/9999'); ?>">Data BPS</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if ($fitur == 'Laporan Indikator') { ?>
                                <li><a href="ui-typography.html">Laporan Indikator</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                    </ul>
                </li>

                <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                    <?php if ($fitur == 'Repositori Dokumen') { ?>
                        <li>
                            <a href="<?= base_url('repositori_dokumen'); ?>" class="waves-effect"><i class="fa fa-book"></i><span> Repositori Dokumen </span></a>
                        </li>
                    <?php break;
                    } ?>
                <?php } ?>


                <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                    <?php if (($fitur == 'Upload Data Indikator') || ($fitur == 'Upload Data APBD') || ($fitur == 'Fitur') || ($fitur == 'Role') || ($fitur == 'User')) { ?>
                        <li class="menu-title">Manajemen</li>
                    <?php break;
                    } ?>
                <?php } ?>

                <li class="has_sub">
                    <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                        <?php if (($fitur == 'Update Data Indikator') || ($fitur == 'Upload Data Indikator') || ($fitur == 'Upload Data APBD')) { ?>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-database"></i> <span> Manajemen Data </span> <span class="menu-arrow"></span></a>
                        <?php break;
                        } ?>
                    <?php } ?>
                    <ul class="list-unstyled">
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if (($fitur == 'Upload Data Indikator')) { ?>
                                <li><a href="<?= base_url('upload_indikator'); ?>">Upload Data Indikator</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if (($fitur == 'Update Data Indikator')) { ?>
                                <li><a href="<?= base_url('update_indikator'); ?>">Update Data Indikator</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if (($fitur == 'Upload Data APBD')) { ?>
                                <li><a href="maps-vector.html">Upload Data APBD</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                    </ul>
                </li>

                <li class="has_sub">
                    <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                        <?php if (($fitur == 'Fitur') || ($fitur == 'Role') || ($fitur == 'User')) { ?>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" aria-hidden="true"></i> <span> Manajemen User </span> <span class="menu-arrow"></span></a>
                        <?php break;
                        } ?>
                    <?php } ?>
                    <ul class="list-unstyled">
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if (($fitur == 'Fitur')) { ?>
                                <li><a href="<?= base_url('fitur'); ?>">Fitur</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if (($fitur == 'Role')) { ?>
                                <li><a href="<?= base_url('role'); ?>">Role</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                        <?php foreach ($this->session->userdata("fitur") as $fitur) { ?>
                            <?php if (($fitur == 'User')) { ?>
                                <li><a href="<?= base_url('user'); ?>">User</a></li>
                            <?php break;
                            } ?>
                        <?php } ?>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

        <div class="help-box">
            <h5 class="text-muted m-t-0">For Help ?</h5>
            <p class=""><span class="text-custom">Email:</span> <br /> support@support.com</p>
            <p class="m-b-0"><span class="text-custom">Call:</span> <br /> (+123) 123 456 789</p>
        </div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->

<!-- Modal Edit Profil -->
<div id="modal-profil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form id="ubah_profil">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Profil Pengguna</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="profilid" name="editid" placeholder="ID" readonly required>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profiluserid" class="control-label">User ID</label>
                                <input type="text" class="form-control" id="profiluserid" name="edituserid" placeholder="User ID" readonly required>
                                <div id="profiledituseridnotif"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profilemail" class="control-label">Email</label>
                                <input type="email" class="form-control" id="profilemail" name="editemail" placeholder="Email" required>
                                <div id="profileditemailnotif"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="profilnama" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="profilnama" name="editnama" placeholder="Nama" required>
                                <div id="profileditnamanotif"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="profilrole" name="editrole" required>
                </div>
                <!-- CSRF Token Field -->
                <input type="text" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal Edit Profil -->

<!-- Modal Password -->
<div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form id="ubah_password">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="editpassid" name="editpassid" placeholder="ID" value="<?= $this->session->userdata("id"); ?>" readonly required>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currentpassword" class="control-label">Current Password</label>
                                <div id="currpass">
                                    <input type="password" class="form-control" style="border-color: transparent; border-radius: 5px 0px 0px 5px; border-right: 0px;" id="currentpassword" name="currentpassword" placeholder="Current Password" required>
                                    <a class="btn btn-icon waves-effect btn-default m-b-5" onclick="seeCurrPass()" style="border-color: transparent; border-radius: 0px 5px 5px 0px; border-left: 0px; margin: 0px !important; align-self: center;"> <i id="iconCurrPass" class="fa fa-eye"></i> </a>
                                </div>
                                <div id="editcurrentpasswordnotif"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="newpassword" class="control-label">New Password</label>
                                <div id="newpass">
                                    <input type="password" class="form-control" style="border-color: transparent; border-radius: 5px 0px 0px 5px; border-right: 0px;" id="newpassword" name="newpassword" placeholder="New Password" required>
                                    <a class="btn btn-icon waves-effect btn-default m-b-5" onclick="seeNewPass()" style="border-color: transparent; border-radius: 0px 5px 5px 0px; border-left: 0px; margin: 0px !important; align-self: center;"> <i id="iconNewPass" class="fa fa-eye"></i> </a>
                                </div>
                                <div id="editnewpasswordnotif"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="repeatnewpassword" class="control-label">Confirm New Password</label>
                                <div id="repnewpass">
                                    <input type="password" class="form-control" style="border-color: transparent; border-radius: 5px 0px 0px 5px; border-right: 0px;" id="repeatnewpassword" name="repeatnewpassword" placeholder="Confirm New Password" required>
                                    <a class="btn btn-icon waves-effect btn-default m-b-5" onclick="seeRepeatNewPass()" style="border-color: transparent; border-radius: 0px 5px 5px 0px; border-left: 0px; margin: 0px !important; align-self: center;"> <i id="iconRepeatNewPass" class="fa fa-eye"></i> </a>
                                </div>
                                <div id="editrepeatnewpasswordnotif"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CSRF Token Field -->
                <input type="text" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal Password -->

<!-- ============================================================== -->
<!-- Start Leftside content here -->
<!-- ============================================================== -->