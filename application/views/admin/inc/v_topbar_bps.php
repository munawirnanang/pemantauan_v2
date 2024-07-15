<!-- ============================================================== -->
<!-- Start Topbar content here -->
<!-- ============================================================== -->

<!-- Top Bar Start -->
<div class="topbar" style="height: 73px;">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <span>
                <img src="<?= base_url('assets') ?>/images/bappenas_putih.png" alt="" height="60">
            </span>
            <i>
                <img src="<?= base_url('assets') ?>/images/bappenas_putih.png" alt="" height="28">
            </i>
        </a>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation" style="display: flex; align-items: center; background-color: white; border-bottom: 2px solid #EAEDEF; height: 73px;">
        <!-- Navbar-left -->
        <ul class="nav navbar-nav navbar-left">
            <li class="hidden-xs">
                <h5>
                    <select id="selectWilayah" <?=$dropdown?> class="selectpicker" data-style="btn-default btn-rounded" data-live-search="true">
                        <?php foreach($wilayah as $w) : ?>
                            <option value="<?= $w['id'] ?>" data-href="<?=base_url('data_bps/').$w['id']?>" <?= $w['id'] == $uri ? 'selected' : '' ?>>
                                <?= $w['nama_wilayah'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </h5>
            </li>
        </ul>
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->

<!-- ============================================================== -->
<!-- Start Topbar content here -->
<!-- ============================================================== -->