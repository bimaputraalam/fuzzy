<?php
switch ($_GET[act]) {
    // Tampil 
    default:

        $id_brand = empty($_GET['id_brand']) ? 0 : $_GET['id_brand'];
        $id_tipe = empty($_GET['id_tipe']) ? 0 : $_GET['id_tipe'];
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">DETAIL PERAMALAN PENJUALAN</h4>
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

                                <h4 class="m-b-30 m-t-0 header-title">DETAIL PERAMALAN PENJUALAN</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="peramalan_penjualan">

                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label" for="name1">Brand</label>
                                            <div class="col-lg-10">
                                                <select class="custom-select mb-3" name="id_brand" required onchange="myFunction(this)">
                                                    <option selected=""> Masukan Brand</option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                                    while ($r = mysql_fetch_array($tampil)) {
                                                        ?>
                                                        <option value="<?= $r[id_brand] ?>" <?= $r[id_brand] == $id_brand ? 'selected' : NULL ?>><?= $r[nama_brand] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="tipe">Tipe</label>

                                            <div class="col-lg-10">
                                                <select class="select2 form-control"  name="id_tipe">
                                                    <option selected=""> Masukan Tipe </option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM rekap "
                                                            . "JOIN tipe ON tipe.id_tipe = rekap.id_tipe "
                                                            . "JOIN kategori ON kategori.id_kategori = tipe.id_kategori "
                                                            . "WHERE id_brand=$id_brand "
                                                            . "GROUP BY tipe.id_tipe "
                                                            . "ORDER BY kategori.nama_kategori ASC");
                                                    $kategori = 0;
                                                    while ($rp = mysql_fetch_array($tampil)) {
                                                        if ($kategori != $rp[id_kategori]) {
                                                            $kategori = $rp[id_kategori];
                                                            ?>
                                                            <optgroup label="<?= $rp[nama_kategori] ?>">
                                                                <?php
                                                            }
                                                            ?>
                                                            <option value="<?= $rp[id_tipe] ?>" <?= $rp[id_tipe] == $id_tipe ? 'selected' : NULL ?> ><?= $rp[nama_tipe] ?></option>
                                                            <?php
                                                            if ($kategori != $rp[id_kategori]) {
                                                                ?>
                                                            </optgroup>
                                                            <?php
                                                        }
                                                        ?>


                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </section>

                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Proses
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    echo '<pre>';
                    $tampil = mysql_query("SELECT * FROM rekap "
                            . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                            . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                            . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                            . "WHERE rekap.id_brand = $id_brand "
                            . "AND rekap.id_tipe = $id_tipe "
                            . "ORDER BY rekap.tanggal");
                    $no = 1;
                    while ($r = mysql_fetch_array($tampil)) {
                        $x[$no++] = $r[total_penjualan];
                    }

                    $n = count($x); // jumlah

                    $a = 2 / ($n + 1); // alpha
//$a = round(2 / ($n + 1), 1);
//$a =0.1;
                    $f[1] = $x[1]; // buat array baru
                    foreach ($x as $index => $value) {
                        $f[$index + 1] = $a * $x[$index] + (1 - $a) * $f[$index];
                    }
//                    echo 'penjualan :';
//                    print_r($x);
//                    echo '<br>';
//
//                    echo 'alpha :';
//                    print_r($a);
//                    echo '<br>';
//
//                    echo 'peramalan :';
//                    print_r($f);
//                    echo '<br>';
//                    $data_js = json_encode($f);



                    echo '</pre>';
                    ?>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Bulan</th>
                                <th>Penjualan</th>
                                <!--<th>Rumus</th>-->
                                <th>Hasil Peramalan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT * FROM rekap "
                                    . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                    . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                    . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                    . "WHERE rekap.id_brand = $id_brand "
                                    . "AND rekap.id_tipe = $id_tipe "
                                    . "ORDER BY rekap.tanggal");
                            $no = 1;
                            $new_r = array();
                            $jmape = 0; // rata-rata mape
                            $jmae = 0; // rata-rata mae
                            while ($r = mysql_fetch_array($tampil)) {
                                $data_insert = new stdClass();
                                $data_insert->periode = date('Y-m', strtotime($r[tanggal]));
                                $data_insert->penjualan = $r[total_penjualan];
                                $data_insert->peramalan = round($f[$no - 1]);
                                array_push($new_r, $data_insert);
                                ?>
                                <?php
                                $mape = abs($f[$no - 1] - $r[total_penjualan]) / $r[total_penjualan];
                                $jmape = $jmape + $mape;  // hitung total mape
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('Y-m', strtotime($r[tanggal])) ?></td>
                                    <td><?= $r[total_penjualan] ?></td>
                                    <!--<td><? $no == 2 ? '=' . $r[total_penjualan] : '=' . round($a, 1) . '*' . $r[total_penjualan] . '+' . '(1 -' . round($a, 1) . ') * ' . round($f[$no - 2]) . '' ?></td>-->
                                    <td><?= round(($f[$no - 1]), 2) ?></td>
            <!--                                    <td><? round($f[$no - 1] - $r[total_penjualan], 2) ?></td>
                                    <td><? round(abs($f[$no - 1] - $r[total_penjualan]), 2) ?></td>-->
            <!--                                    <td><? round(abs($f[$no - 1] - $r[total_penjualan]) / $r[total_penjualan], 2) ?> </td>-->

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
                                    <th style="width: 20px"><?= $no ?></th>
                                    <th><?= $xnextDate = date('Y-m', strtotime($date . " +1 month"))?></th>
                                    <th></th>
                                    <th><?= round($f[$no], 2) ?></th>

                                </tr>
                                <tr>
                                    <th></th>
                                    <th colspan="2">Tingkat Akurasi</th>
                                    
                                    <th><?php
                                        $tmape = round($jmape / $n, 2);
                                        echo $tmape . '%';
                                        ?>
                                        (<?php
                                        if ($tmape <= 10) {
                                            echo 'Tinggi';
                                        } else if ($mape > 10 && $mape <= 20) {
                                            echo 'Baik';
                                        } else if ($mape > 20 && $mape <= 50) {
                                            echo 'Reasonable';
                                        } else if ($mape > 50) {
                                            echo 'Rendah';
                                        }
                                        ?>) 
                                    </th>                                  
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
                    Hasil Peramalan Penjualan Periode yang Akan Datang <b><?= ceil($f[$no]) ?></b>.
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
                                            <h6 style="color: #1bb99a;"><i class="zmdi zmdi-minus m-r-5"></i>Penjualan</h6>
                                            <h6 style="color: #f1b53d;"><i class="zmdi zmdi-minus m-r-5"></i>Hasil Peramalan</h6>

                                        </li>

                                    </ul>
                                </div>

                                <div id="morris-line-example1" class="morris-chart" style="height: 300px;"></div>

                            </div>
                        </div>

                    </div>
                    </div>
            </div>

        </div>
        <!-- end row -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="plugins/morris/morris.min.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>
        <script src="assets/pages/jquery.morris.init.js"></script>


        <script>

                                                    function myFunction(id) {
                                                        //                alert("The input value has changed. The new value is: " + id.value);
                                                        window.location.href = "?module=peramalan_penjualan&id_brand=" + id.value;
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
    case 'all':
        $id_brand = empty($_GET['id_brand']) ? 0 : $_GET['id_brand'];
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">PERAMALAN PENJUALAN</h4>
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

                                <h4 class="m-b-30 m-t-0 header-title">PERAMALAN PENJUALAN</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="peramalan_penjualan">
                                    <input type="hidden" name="act" value="all">
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label" for="name1">Brand</label>
                                            <div class="col-lg-10">
                                                <select class="custom-select mb-3" name="id_brand" required onchange="myFunction(this)">
                                                    <option selected=""> Masukan Brand</option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                                    while ($r = mysql_fetch_array($tampil)) {
                                                        ?>
                                                        <option value="<?= $r[id_brand] ?>" <?= $r[id_brand] == $id_brand ? 'selected' : NULL ?>><?= $r[nama_brand] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </section>


                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Proses
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Kategori</th>
                                <th>Tipe</th>
                                <th>Hasil Peramalan</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $tampil = mysql_query("SELECT * FROM rekap "
                                    . "JOIN tipe ON tipe.id_tipe = rekap.id_tipe "
                                    . "JOIN kategori ON kategori.id_kategori = tipe.id_kategori "
                                    . "WHERE id_brand=$id_brand "
                                    . "GROUP BY tipe.id_tipe "
                                    . "ORDER BY kategori.nama_kategori ASC"); // query data rekap

                            while ($rp = mysql_fetch_array($tampil)) {
                                $x = array();
                                $f = array();

                                $tampil2 = mysql_query("SELECT * FROM rekap "
                                        . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                        . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                        . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                        . "WHERE rekap.id_brand = $id_brand "
                                        . "AND rekap.id_tipe = $rp[id_tipe] "
                                        . "ORDER BY rekap.tanggal");
                                $nos = 1;
                                while ($r = mysql_fetch_array($tampil2)) {
                                    $x[$nos++] = $r[total_penjualan];
                                }

                                $n = count($x); // jumlah periode

                                $a = 2 / ($n + 1); // alpha
//$a = round(2 / ($n + 1), 1);
//$a =0.1;
                                $f[1] = $x[1];
                                foreach ($x as $index => $value) { // looping array
                                    $f[$index + 1] = $a * $x[$index] + (1 - $a) * $f[$index];
                                }
                                ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $rp[nama_kategori] ?></td>
                                    <td><?= $rp[nama_tipe] ?></td>
                                    <td><?= ceil($f[$n + 1]) ?> Items</td>
                                    <td>
                                        <a type="button" href='?module=peramalan_penjualan&id_brand=<?= $id_brand ?>&id_tipe=<?= $rp[id_tipe] ?>' target="_blank" class="btn waves-effect waves-light btn-success"><i class="fa fa-info"></i></a>
                                    </td>


                                </tr>
                                <?php
                            }
                            ?>   
                        </tbody>

                    </table>
                    <hr>

                </div>
            </div>
        </div>


        <?php
        break;
    case 'sample':

        $id_brand = empty($_GET['id_brand']) ? 0 : $_GET['id_brand'];
        $id_tipe = empty($_GET['id_tipe']) ? 0 : $_GET['id_tipe'];
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">DETAIL PERHITUNGAN PERAMALAN PENJUALAN</h4>
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

                                <h4 class="m-b-30 m-t-0 header-title">DETAIL PERHITUNGAN PERAMALAN PENJUALAN</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="peramalan_penjualan">
                                    <input type="hidden" name="act" value="sample">

                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label" for="name1">Brand</label>
                                            <div class="col-lg-10">
                                                <select class="custom-select mb-3" name="id_brand" required onchange="myFunction(this)">
                                                    <option selected=""> Masukan Brand</option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                                    while ($r = mysql_fetch_array($tampil)) {
                                                        ?>
                                                        <option value="<?= $r[id_brand] ?>" <?= $r[id_brand] == $id_brand ? 'selected' : NULL ?>><?= $r[nama_brand] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="tipe">Tipe</label>

                                            <div class="col-lg-10">
                                                <select class="select2 form-control"  name="id_tipe">
                                                    <option selected=""> Masukan Tipe </option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM rekap "
                                                            . "JOIN tipe ON tipe.id_tipe = rekap.id_tipe "
                                                            . "JOIN kategori ON kategori.id_kategori = tipe.id_kategori "
                                                            . "WHERE id_brand=$id_brand "
                                                            . "GROUP BY tipe.id_tipe "
                                                            . "ORDER BY kategori.nama_kategori ASC");
                                                    $kategori = 0;
                                                    while ($rp = mysql_fetch_array($tampil)) {
                                                        if ($kategori != $rp[id_kategori]) {
                                                            $kategori = $rp[id_kategori];
                                                            ?>
                                                            <optgroup label="<?= $rp[nama_kategori] ?>">
                                                                <?php
                                                            }
                                                            ?>
                                                            <option value="<?= $rp[id_tipe] ?>" <?= $rp[id_tipe] == $id_tipe ? 'selected' : NULL ?> ><?= $rp[nama_tipe] ?></option>
                                                            <?php
                                                            if ($kategori != $rp[id_kategori]) {
                                                                ?>
                                                            </optgroup>
                                                            <?php
                                                        }
                                                        ?>


                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </section>

                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Proses
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    echo '<pre>';
                    $tampil = mysql_query("SELECT * FROM rekap "
                            . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                            . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                            . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                            . "WHERE rekap.id_brand = $id_brand "
                            . "AND rekap.id_tipe = $id_tipe "
                            . "ORDER BY rekap.tanggal");
                    $no = 1;
                    while ($r = mysql_fetch_array($tampil)) {
                        $x[$no++] = $r[total_penjualan];
                    }

                    $n = count($x); // jumlah

                    $a = 2 / ($n + 1); // alpha
//$a = round(2 / ($n + 1), 1);
//$a =0.1;
                    $f[1] = $x[1]; // buat array baru
                    foreach ($x as $index => $value) {
                        $f[$index + 1] = $a * $x[$index] + (1 - $a) * $f[$index];
                    }
//                    echo 'penjualan :';
//                    print_r($x);
//                    echo '<br>';
//
//                    echo 'alpha :';
//                    print_r($a);
//                    echo '<br>';
//
//                    echo 'peramalan :';
//                    print_r($f);
//                    echo '<br>';
//                    $data_js = json_encode($f);



                    echo '</pre>';
                    ?>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Bulan</th>
                                <th>Penjualan</th>
                                <!--<th>Rumus</th>-->
                                <th>Hasil Peramalan</th>
                                <th>MSE</th>
                                <th>MAE</th>
                                <th>MAPE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT * FROM rekap "
                                    . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                    . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                    . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                    . "WHERE rekap.id_brand = $id_brand "
                                    . "AND rekap.id_tipe = $id_tipe "
                                    . "ORDER BY rekap.tanggal");
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
                                    <td><?= $r[total_penjualan] ?></td>
                                    <!--<td><? $no == 2 ? '=' . $r[total_penjualan] : '=' . round($a, 1) . '*' . $r[total_penjualan] . '+' . '(1 -' . round($a, 1) . ') * ' . round($f[$no - 2]) . '' ?></td>-->
                                    <td><?= $f[$no - 1] ?></td>
                                    <td><?= $r[total_penjualan] - $f[$no - 1] ?></td>
                                    <td><?= abs($f[$no - 1] - $r[total_penjualan]) ?></td>
                                    <?php
                                    $mae= abs($f[$no - 1] - $r[total_penjualan]);
                                    $jmae = $jmae + $mae;
                                    ?>
                                    <td><?= abs($f[$no - 1] - $r[total_penjualan]) / $r[total_penjualan] ?> </td>
                                    <?php
                                    $mape = abs($f[$no - 1] - $r[total_penjualan]) / $r[total_penjualan];
                                    $jmape = $jmape + $mape;  // hitung total mape
                                    ?>
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
                                    <th style="width: 20px"><?= $no ?></th>
                                    <th colspan="2">Hasil Peramalan</th>
                                    <th colspan="4"><?= $f[$no] ?></th>
                                    
                                    

                                </tr>
                                <tr>
                                    <th colspan="5">Rata-rata</th>
                                    <th><?php
                                    $tmae = $jmae / $n;
                                    echo $tmae;
                                    ?>
                                    </th>
                                    <th><?php
                                    $tmape = $jmape / $n;
                                    echo $tmape;
                                    ?>% </th>

                                </tr>
                                <tr>
                                    <th colspan="6">Tingkat Akurasi</th>
                                    <th><?php
                                        if ($tmape <= 10) {
                                            echo 'Tinggi';
                                        } else if ($mape > 10 && $mape <= 20) {
                                            echo 'Baik';
                                        } else if ($mape > 20 && $mape <= 50) {
                                            echo 'Reasonable';
                                        } else if ($mape > 50) {
                                            echo 'Rendah';
                                        }
                                        ?></th>

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
                window.location.href = "?module=peramalan_penjualan&act=sample&id_brand=" + id.value;
            }
        </script>



        <?php
        break;
}
?>

