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
                    <h4 class="page-title">LAPORAN</h4>
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

                                <h4 class="m-b-30 m-t-0 header-title">LAPORAN GRAFIK</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="laporan_grafik">
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
                                            Tampilkan
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    $tampil = mysql_query("SELECT rekap.tanggal, rekap.stok_awal, rekap.total_pengadaan, rekap.total_pengembalian, rekap.total_penjualan, rekap.stok_akhir FROM rekap "
                                    . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                    . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                    . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                    . "WHERE rekap.id_brand = $id_brand "
                                    . "AND rekap.id_tipe = $id_tipe "
                                    . "ORDER BY rekap.tanggal");
                    echo '<pre>';
                    $new_r = array();
                    while ($r = mysql_fetch_object($tampil)) {
                        array_push($new_r, $r);
                    }

                    $data_js = json_encode($new_r);
//                   print_r($data_js);
                    echo '</pre>';
                    ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="p-20">
                                            <div class="text-center">
                                                <ul class="list-inline chart-detail-list">
                                                    <li class="list-inline-item">
                                                        <h6 style="color: #1bb99a;"><i class="zmdi zmdi-minus m-r-5"></i>Stok Awal</h6>
                                                        <h6 style="color: #f1b53d;"><i class="zmdi zmdi-minus m-r-5"></i>Total Pengadaan</h6>
                                                        <h6 style="color: #232dae;"><i class="zmdi zmdi-minus m-r-5"></i>Total Pengembalian</h6>
                                                        <h6 style="color: #f83919;"><i class="zmdi zmdi-minus m-r-5"></i>Total Penjualan</h6>
                                                        <h6 style="color: #ec0edd;"><i class="zmdi zmdi-minus m-r-5"></i>Stok Akhir</h6>
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
                    
                    <?php
                    break;
            }
            ?>
            <script src="assets/js/jquery.min.js"></script>
            <!--Morris Chart-->
            <script src="plugins/morris/morris.min.js"></script>
            <script src="plugins/raphael/raphael.min.js"></script>
            <script src="assets/pages/jquery.morris.init.js"></script>

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

                                                            this.createLineChart('morris-line-example1', <?= $data_js ?>, 'tanggal', ['stok_awal', 'total_pengadaan','total_pengembalian','total_penjualan','stok_akhir'], ['Stok Awal','Total Pengadaan','Total Pengembalian','Total Penjualan','Stok Akhir'], ['0.1'], ['#ffffff'], ['#999999'], ['#1bb99a', '#f1b53d','#232dae','#f83919','#ec0edd']);

                                                        }

                                                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
                                                $.MorrisCharts.init();
                                            });

            </script>
            
        <script>

            function myFunction(id) {
//                alert("The input value has changed. The new value is: " + id.value);
                window.location.href = "?module=laporan_grafik&id_brand="+id.value;
            }
        </script>