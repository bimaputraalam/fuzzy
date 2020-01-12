<?php
switch ($_GET[act]) {
    // Tampil 
    default:

        $id = empty($_GET['id']) ? 0 : $_GET['id'];
        
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">DETAIL PERAMALAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">

                                <h4 class="m-b-30 m-t-0 header-title">DETAIL PERAMALAN</h4>
                                <hr>
                                
                            </div>
                        </div>
                    </div>

                    <?php
                    echo '<pre>';
                    $tampil = mysql_query("SELECT * FROM padi ");
                    $no = 1;
                    while ($r = mysql_fetch_array($tampil)) {
                        $x[$no++] = $r[hasil_panen];
                    }



                    echo '</pre>';
                    ?>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Bulan</th>
                                <th>Hasil Panen</th>
                                <!--<th>Rumus</th>-->
                                <th>Hasil Peramalan</th>
                                <th>MAPE</th>
                                <th>Tingkat Akurasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT * FROM padi ");
                            $no = 1;
                            $new_r = array();
                            while ($r = mysql_fetch_array($tampil)) {
                                $data_insert = new stdClass();
                                $data_insert->periode = date('Y-m', strtotime($r[tanggal]));
                                $data_insert->penjualan = $r[total_penjualan];
                                $data_insert->peramalan = round($f[$no - 1]);
                                array_push($new_r, $data_insert);
                                ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('Y-m', strtotime($r[tanggal])) ?></td>
                                    <td><?= $r[hasil_panen] ?></td>
                                    <!--<td><? $no == 2 ? '=' . $r[total_penjualan] : '=' . round($a, 1) . '*' . $r[total_penjualan] . '+' . '(1 -' . round($a, 1) . ') * ' . round($f[$no - 2]) . '' ?></td>-->
                                    <td><?= round(($f[$no - 1]),2) ?></td>
            <!--                                    <td><? round($f[$no - 1] - $r[total_penjualan], 2) ?></td>
                                    <td><? round(abs($f[$no - 1] - $r[total_penjualan]), 2) ?></td>-->
                                    <td><?= round(abs($f[$no - 1] - $r[hasil_panen]) / $r[hasil_panen], 2) ?> %</td>
                                    <td><?php
                                        $mape = abs($f[$no - 1] - $r[hasil_panen]) / $r[hasil_panen];
                                        if ($mape <= 10) {
                                            echo 'Tinggi';
                                        }else if($mape > 10 && $mape <=20){
                                            echo 'Baik';
                                        }else if($mape > 20 && $mape <=50){
                                            echo 'Reasonable';
                                        }else if($mape > 50){
                                            echo 'Rendah';
                                        }
                                        ?> </td>
                                </tr>
                                <?php
                                $date = $r[tanggal];
                            }
                            ?>   
                        </tbody>
                        <?php
                        if ($_GET) {
                            $nextDate = date('Y-m-d', strtotime($date . " +1 month"));
                            $data_insert = new stdClass();
                            $data_insert->periode = date('Y-m', strtotime($nextDate));
                            $data_insert->penjualan = NULL;
                            $data_insert->peramalan = round($f[$no]);
                            array_push($new_r, $data_insert);
                            ?>

                            <tfoot>							
                                <tr>
                                    <th style="width: 20px"></th>
                                    <th>Hasil Peramalan</th>
                                    <th></th>
                                    <!--<th></th>-->

                                    <th><?= round($f[$no], 2) ?></th>
                                    <th></th>
                                    
                                    <th></th>
                                </tr>
                            </tfoot>
                            <?php
                        }
                        ?>
                    </table>
                    <hr>
                    <?php
                    $data_js = json_encode($new_r);

                    echo '<pre>';

//                    print_r($data_js);
                    echo '</pre>';
                    ?>
                    Hasil Peramalan Panen Periode yang Akan Datang <b><?= ceil($f[$no]) ?></b>.
                    <div class="hidden-print">
                        <div class="btn-group float-right m-t-15">
                            <a type="button" href='?module=peramalan_penjualan&act=sample&id_brand=<?= $id_brand ?>&id_tipe=<?= $id_tipe ?>' class="btn btn-primary waves-effect waves-light">Detail Perhitungan</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="p-20">
                                <div class="text-center">
                                    <ul class="list-inline chart-detail-list">
                                        <li class="list-inline-item">
                                            <h6 style="color: #1bb99a;"><i class="zmdi zmdi-minus m-r-5"></i>Hasil Panen</h6>
                                            <h6 style="color: #f1b53d;"><i class="zmdi zmdi-minus m-r-5"></i>Hasil Peramalan</h6>

                                        </li>

                                    </ul>
                                </div>

                                <div id="morris-line-example1" class="morris-chart" style="height: 300px;"></div>

                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <!-- end row -->

                    <!-- end row -->

                </div>
            </div><!-- end col-->

        </div>
        <!-- end row -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>
        <script src="assets/pages/jquery.morris.init.js"></script>


        <script>

            function myFunction(id) {
                //                alert("The input value has changed. The new value is: " + id.value);
                window.location.href = "?module=peramalan_penjualan&id=" + id.value;
            }
        </script>




        <script>
            $(document).ready(function () {

                var MorrisCharts = function () {};

                //creates line chart
                MorrisCharts.prototype.createLineChart = function (element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
                    Morris.Line({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        labels: labels,
                        fillOpacity: opacity,
                        pointFillColors: Pfillcolor,
                        pointStrokeColors: Pstockcolor,
                        behaveLikeLine: true,
                        gridLineColor: '#eef0f2',
                        hideHover: 'auto',
                        lineWidth: '3px',
                        pointSize: 0,
                        preUnits: '',
                        resize: true, //defaulted to true
                        lineColors: lineColors
                    });
                },
                        MorrisCharts.prototype.init = function () {

                            this.createLineChart('morris-line-example1', <?= $data_js ?>, 'periode', ['penjualan', 'peramalan'], ['Penjualan', 'Peramalan'], ['0.1'], ['#ffffff'], ['#999999'], ['#1bb99a', '#f1b53d']);

                        }

                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
                $.MorrisCharts.init();
            });

        </script>
        <?php
        break;
    case 'sample':

        $id = empty($_GET['id']) ? 0 : $_GET['id'];
        
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">DETAIL PERHITUNGAN PERAMALAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">

                                <h4 class="m-b-30 m-t-0 header-title">DETAIL PERHITUNGAN PERAMALAN</h4>
                                <hr>
                              
                            </div>
                        </div>
                    </div>

                    <?php
                    echo '<pre>';
                    $tampil = mysql_query("SELECT * FROM padi");
                    $no = 1;
                    while ($r = mysql_fetch_array($tampil)) {
                        $x[$no++] = $r[hasil_panen];
                    }

                    echo '</pre>';
                    ?>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Bulan</th>
                                <th>Hasil Panen</th>
                                <!--<th>Rumus</th>-->
                                <th>Hasil Peramalan</th>
                                <th>MSE</th>
                                <th>MAE</th>
                                <th>MAPE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT * FROM padi ");
                            $no = 1;
                            $new_r = array();
                            while ($r = mysql_fetch_array($tampil)) {
                                $data_insert = new stdClass();
                                $data_insert->periode = date('Y-m', strtotime($r[tanggal]));
                                $data_insert->penjualan = $r[hasil_panen];
                                $data_insert->peramalan = round($f[$no - 1]);
                                array_push($new_r, $data_insert);
                                ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('Y-m', strtotime($r[tanggal])) ?></td>
                                    <td><?= $r[hasil_panen] ?></td>
                                    <!--<td><? $no == 2 ? '=' . $r[total_penjualan] : '=' . round($a, 1) . '*' . $r[total_penjualan] . '+' . '(1 -' . round($a, 1) . ') * ' . round($f[$no - 2]) . '' ?></td>-->
                                    <td><?= $f[$no - 1] ?></td>
                                    <td><?= $r[hasil_panen] - $f[$no - 1] ?></td>
                                    <td><?= abs($r[hasil_panen] - $f[$no - 1]) ?></td>
                                    <td><?= abs($f[$no - 1] - $r[hasil_panen]) / $r[hasil_panen] ?> %</td>
                                </tr>
                                <?php
                                $date = $r[tanggal];
                            }
                            ?>   
                        </tbody>
                        <?php
                        if ($_GET) {
                            $nextDate = date('Y-m-d', strtotime($date . " +1 month"));
                            $data_insert = new stdClass();
                            $data_insert->periode = date('Y-m', strtotime($nextDate));
                            $data_insert->penjualan = NULL;
                            $data_insert->peramalan = round($f[$no]);
                            array_push($new_r, $data_insert);
                            ?>

                            <tfoot>							
                                <tr>
                                    <th style="width: 20px"></th>
                                    <th>Hasil Peramalan</th>
                                    <th></th>
                                    <!--<th></th>-->

                                    <th><?= $f[$no] ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <?php
                        }
                        ?>
                    </table>
                    <hr>
                    <?php
                    $data_js = json_encode($new_r);

                    echo '<pre>';

//                    print_r($data_js);
                    echo '</pre>';
                    ?>
                    Dengan Alpha = <b><?= $a ?></b>, Hasil Peramalan <b><?= $f[$no] ?></b>.

                </div>
            </div>
        </div>

        <script src="assets/js/jquery.min.js"></script>


        <script>

                function myFunction(id) {
                    //                alert("The input value has changed. The new value is: " + id.value);
                    window.location.href = "?module=peramalan_penjualan&act=sample&id=" + id.value;
                }
        </script>



        <?php
        break;
}
?>

