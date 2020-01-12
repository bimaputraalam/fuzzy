<?php
switch ($_GET[act]) {
    // Tampil 
    default:
        $bulan = empty($_GET['bulan']) ? date('Y-m') : $_GET['bulan'];
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
                                <h4 class="m-b-30 m-t-0 header-title">TOTAL PENJUALAN</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="laporan">
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="bulan">Bulan</label>
                                            <div class="col-lg-10">
                                                <input id="bulan" name="bulan" type="month" class="form-control" value="<?= $bulan ?>" placeholder="Bulan" required>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Tampilkan
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    $data_bulan = date('m', strtotime($bulan));
                    $data_tahun = date('Y', strtotime($bulan));
                    ?>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Brand</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT brand.*, SUM(total_penjualan) as total_penjualan FROM rekap "
                                    . "RIGHT JOIN brand ON brand.id_brand = rekap.id_brand "
                                    . "WHERE MONTH(tanggal)='" . $data_bulan . "'"
                                    . "AND YEAR(tanggal)='" . $data_tahun . "'"
                                    . "GROUP BY rekap.id_brand");
                            $no = 1;
                            while ($r = mysql_fetch_array($tampil)) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $r[nama_brand] ?></td>
                                    <td><?= $r[total_penjualan] ?></td>
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
}
?>