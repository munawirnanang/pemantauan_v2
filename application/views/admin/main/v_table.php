<!-- ============================================================== -->
<!-- Start content here -->
<!-- ============================================================== -->

<?php
    $idvariabel = $api['var'][0]['val'];
    $baris = count($api['vervar']);
    $karakter = count($api['turvar']);
    $tahun = count($api['tahun']);
    $bulan = count($api['turtahun']);

    $title = $api['var'][0]['label'];

    
?>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?= $title?></h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="<?php echo base_url().$menu ?>"><?php echo $menu?></a>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title m-b-15"><b>API</b></h4>
                        <table id="datatable" class="table table-striped table-bordered">
                            <?php
                                echo "<thead>";
                                if($bulan == 1 && $karakter== 1){
                                    echo "<tr><th rowspan='3'>".$api['labelvervar']."</th></tr>";
                                    echo "<tr><th colspan='".$tahun."'>".$api['var'][0]['label']."</th><tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$tahun;$i++){
                                        echo "<th>".$api['tahun'][$i]['label']."</th>";
                                    }
                                    echo "</tr>";
                                }elseif($bulan > 1 && $karakter==1){
                                    echo "<tr><th rowspan='4'>".$api['labelvervar']."</th></tr>";
                                    echo "<tr><th colspan='".$tahun*$bulan."'>".$api['var'][0]['label']."</th><tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$tahun;$i++){
                                        echo "<th colspan='".$bulan."'>".$api['tahun'][$i]['label']."</th>";
                                    }
                                    
                                    echo "<tr>";
                                    for($i=0;$i<$tahun;$i++){
                                        for($j=0;$j<$bulan;$j++){
                                            echo "<th>".$api['turtahun'][$j]['label']."</th>";
                                        }
                                    }
                                    echo "</tr>";
                                }elseif($bulan == 1 && $karakter > 1){
                                    echo "<tr><th rowspan='4'>".$api['labelvervar']."</th></tr>";
                                    echo "<tr><th colspan='".$karakter*$tahun."'>".$api['var'][0]['label']."</th><tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$karakter;$i++){
                                        echo "<th colspan='".$tahun."'>".$api['tahun'][$i]['label']."</th>";
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$karakter;$i++){
                                        for($j=0;$j<$tahun;$j++){
                                            echo "<th>".$api['turtahun'][$j]['label']."</th>";
                                        }
                                    }
                                    echo "</tr>";
                                }elseif($bulan > 1 && $karakter > 1){
                                    echo "<tr><th rowspan='5'>".$api['labelvervar']."</th></tr>";
                                    echo "<tr><th colspan='".$karakter*$tahun*$bulan."'>".$api['var'][0]['label']."</th><tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$karakter;$i++){
                                        echo "<th colspan='".$bulan."'>".$api['tahun'][$i]['label']."</th>";
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$karakter;$i++){
                                        for($j=0;$j<$tahun;$j++){
                                            echo "<th colspan='".$bulan."'>".$api['tahun'][$j]['label']."</th>";
                                        }
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    for($i=0;$i<$karakter;$i++){
                                        for($j=0;$j<$tahun;$j++){
                                            for($k=0;$k<$bulan;$l++){
                                                echo "<th>".$api['turtahun'][$k]['label']."</th>";
                                            }
                                        }
                                    }
                                }
                                    echo "</tr>";
                                    echo "</thead>";
                                    
                                    echo "<tbody>";
                                    for($i=0;$i<$baris;$i++){
                                        echo "<tr>";
                                        echo "<td>".$api['vervar'][$i]['label']."</td>";
                                        for($j=0;$j<$karakter;$j++){
                                            for($k=0;$k<$tahun;$k++){
                                                for($l=0;$l<$bulan;$l++){
                                                    $id_data=$api['vervar'][$i]['val'].
                                                            $idvariabel.
                                                            $api['turvar'][$j]['val'].
                                                            $api['tahun'][$k]['val'].
                                                            $api['turtahun'][$l]['val'];
                                                    $data = isset($api['datacontent'][$id_data])?$api['datacontent'][$id_data]:"-";
                                                    echo "<td>".$data."</td>";
                                                }
                                            }
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer text-right">
        2016 - 2018 © Zircos theme by Coderthemes.
    </footer>

</div>

<!-- ============================================================== -->
<!-- End rightside content here -->
<!-- ============================================================== -->