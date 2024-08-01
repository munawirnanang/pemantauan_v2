<div class="content-page">
    <!-- Start content -->
    <div class="content">
    <!-- <div class="content" style="margin-top: 0px;"> -->
        <div class="container">

            <div class="row">
                <div id="goal-container" class="scroll-container m-t-15">
                    <?php for ($i = 1; $i < 18; $i++) : ?>
                        <a href="#" data-goal="<?= $i ?>" id="goal-link-<?= $i ?>" class="goal-link">
                            <img src="<?= base_url('assets/sdgs/G') . $i . '.png' ?>" class="thumb-lg m-b-10">
                        </a>
                    <?php endfor ?>
                </div>
            </div>
            <div class="m-0 text-uppercase font-600 font-secondary text-overflow m-t-15" id="card-title">
                
            </div>

            <div class="scroll-container m-t-15 text-center" id="card-item">
                
            </div>

            <div class="row m-t-15" id="nav-list">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs tabs-bordered">
                        <li class="active">
                            <a href="#data-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-database"></i></span>
                                <span class="hidden-xs">List Data</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#cari-b1" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-search"></i></span>
                                <span class="hidden-xs">Data</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="data-b1">
                            <div class="m-t-15" id="tabel_sdgs">
                        </div>      
                        </div>
                        <div class="tab-pane" id="cari-b1">

                        </div>
                    </div>
                </div>
            </div>
            

            
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>
</div>
