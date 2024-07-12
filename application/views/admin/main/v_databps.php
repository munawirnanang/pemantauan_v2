<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row m-t-15">
                <div class="col-lg-12">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                        <center><h3 class="mr-3">Data Badan Pusat Statistik</h3>
                        <img src="<?=base_url('assets')?>/assets/images/searching.png" class="img-responsive img-rounded" width="400"></center>
                    </div>
                </div>
            </div>
            <div class="row m-t-15">
                <?php $o=0 ;?>
                <?php foreach($unique as $item) :?>
                    <div class="col-lg-4">
                        <div class="<?=$card[$o]?>">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= $item['subcat']?></h3>
                                <p class="panel-sub-title font-13 text-muted"></p>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <?php foreach($categories as $i) :?>
                                         <?php if($item['subcat_id']==$i['subcat_id']) :?>
                                            <a href="<?=base_url('data_kategori/').$i['sub_id']?>?uri=<?=$uri?>"  class="list-group-item list-group-item-action"><?= $i['title']?></a>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $o++;?>
            <?php endforeach;?>
            <!-- <?php if($item['id_sub_kategori']==$i['id_sub_kategori']) :?>
                <a href="<?=base_url('data_kategori/').$i['id']?>?uri=<?=$uri?>"  class="list-group-item list-group-item-action"><?= $i['nama_kategori']?></a>
            <?php endif ?> -->
            </div>
            <div class="row m-t-15">
                <div class="col-lg-12">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                        <a href="<?= base_url('data_kategori/1000')?>?uri=<?=$uri?>" type="button" class="btn btn-rounded btn-block btn--md btn-info waves-effect waves-light">Tampilkan Semua Data</a>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>

</div>
<script>
   function toggleButtonText(button) {
    if (button.innerText === "Show More") {
        button.innerText = "Show Less";
    } else {
        button.innerText = "Show More";
    }
}
</script>


<!-- ============================================================== -->
<!-- End rightside content here -->
<!-- ============================================================== -->
