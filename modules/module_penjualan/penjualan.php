<?php
$aksi = "modules/module_penjualan/aksi_penjualan.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">PENJUALAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <div class="row" style="width:1500px">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right m-t-15">
                                    <a type="button" href='?module=penjualan&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Penjualan</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA PENJUALAN    </h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th>Tanggal</th>
                                <th>Brand</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Tipe</th>
                                <th>Warna</th>
                                <th>Ukuran</th>
                                <th>Jenis Kelamin</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th style="width: 20px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT * FROM transaksi 
                                           JOIN ukuran_produk 
                                           ON ukuran_produk.id_ukuran_produk=transaksi.id_ukuran_produk
                                           JOIN ukuran 
                                           ON ukuran.id_ukuran=ukuran_produk.id_ukuran
                                           JOIN produk 
                                           ON produk.id_produk=ukuran_produk.id_produk
                                           JOIN brand 
                                           ON brand.id_brand=produk.id_brand
                                           JOIN warna 
                                           ON warna.id_warna=produk.id_warna
                                           JOIN jenis_kelamin 
                                           ON jenis_kelamin.id_jenis_kelamin=produk.id_jenis_kelamin
                                           JOIN tipe 
                                           ON tipe.id_tipe=produk.id_tipe
                                           JOIN kategori 
                                           ON kategori.id_kategori=tipe.id_kategori");
                            $no = 1;
                            while ($r = mysql_fetch_array($tampil)) {
                                ?>

                                <tr>
                                    <td><?= $r[tanggal] ?></td>
                                    <td><?= $r[nama_brand] ?></td>
                                    <td><?= $r[nama_produk] ?></td>
                                    <td><?= $r[nama_kategori] ?></td>
                                    <td><?= $r[nama_tipe] ?></td>
                                    <td><?= $r[nama_warna] ?></td>
                                    <td><?= $r[nama_ukuran] ?></td>
                                    <td><?= $r[nama_jenis_kelamin] ?></td>
                                    <th><?= $r[harga] ?></th>
                                    <th><?= $r[qty_terjual] ?></th>
                                    <th><?php
                                        $qty = $r[qty_terjual];
                                        $harga = $r[harga];
                                        $total = $harga * $qty;
                                        echo $total;
                                        ?>
                                    </th>
                                    <td>
                                        <a type="button" href='?module=penjualan&act=edit&id=<?= $r[id_transaksi] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                        <a type="button" href=<?= $aksi ?>?module=penjualan&act=hapus&id=<?= $r[id_transaksi] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>
                    <hr>
                    <div class="hidden-print">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>     
        <?php
        break;

    // Form Tambah 
    case "tambah":
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH PENJUALAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <hr>

        <div class="p-20">
            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=penjualan&act=input'>
                <section>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="tanggal">Tanggal</label>
                        <div class="col-lg-10">
                            <input class="form-control input-daterange-datepicker" type="date" name="tanggal" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="brand">Produk</label>
                        <div class="col-lg-10">
                            <select class="select2 form-control"  name="id_ukuran_produk">
                                <option selected=""> Masukan Produk </option>
                                <?php
                                $tampil = mysql_query("SELECT * FROM ukuran_produk
                                                                        JOIN produk ON produk.id_produk=ukuran_produk.id_produk
                                                                        JOIN ukuran ON ukuran.id_ukuran=ukuran_produk.id_ukuran
                                                                        ORDER BY produk.nama_produk ASC");
                                $produk = 0;
                                while ($rp = mysql_fetch_array($tampil)) {
                                    if ($produk != $rp[id_produk]) {
                                        $produk = $rp[id_produk];
                                        ?>
                                        <optgroup label="<?= $rp[nama_produk] ?>">
                                            <?php
                                        }
                                        ?>
                                        <option value="<?= $rp[id_ukuran_produk] ?>"><?= $rp[nama_ukuran] . ' ' . $rp[nama_produk] . ' Rp.' . number_format($rp[harga]) ?></option>
                                        <?php
                                        if ($produk != $rp[id_produk]) {
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
                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="Qty">Qty</label>
                        <div class="col-lg-10">
                            <input id="Qty" name="qty_terjual" type="number" class="form-control" placeholder="Masukan Qty" required>
                        </div>
                    </div>

                </section>
              
                <!--/
                <div class="form-group row">
                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                </div> -->
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="submit" href="module.php?module=laporan_tabel">
                        Submit
                    </button>
                    <button type="reset" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>
                </div>
            </form>  
             <hr>
        </div>
        </div>
        </div>
        </div>
        <!-- end row -->    
        
        <?php
        break;

    // Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- end row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH PENJUALAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

        <div class="p-20">
            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=penjualan&act=update'>
                <section>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="tanggal">Tanggal</label>
                        <div class="col-lg-10">
                            <input class="form-control input-daterange-datepicker" type="date" name="tanggal" value="<?= $r[tanggal] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="brand">Produk</label>
                        <div class="col-lg-10">
                            <select class="select2 form-control"  name="id_ukuran_produk">
                                <option selected=""> Masukan Produk </option>
                                <?php
                                $tampil = mysql_query("SELECT * FROM ukuran_produk
                                                                        JOIN produk ON produk.id_produk=ukuran_produk.id_produk
                                                                        JOIN ukuran ON ukuran.id_ukuran=ukuran_produk.id_ukuran
                                                                        ORDER BY produk.nama_produk ASC");
                                $produk = 0;
                                while ($rp = mysql_fetch_array($tampil)) {
                                    if ($produk != $rp[id_produk]) {
                                        $produk = $rp[id_produk];
                                        ?>
                                        <optgroup label="<?= $rp[nama_produk] ?>">
                                            <?php
                                        }
                                        ?>
                                        <option value="<?= $rp[id_ukuran_produk] ?>" <?= $rp[id_ukuran_produk] == $rp[id_ukuran_produk] ? 'selected' : NULL ?>><?= $rp[nama_ukuran] . ' ' . $rp[nama_produk] . ' Rp.' . number_format($rp[harga]) ?></option>
                                        <?php
                                        if ($produk != $rp[id_produk]) {
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
                    <div class="form-group row">
                        <label class="col-lg-2 control-label" for="qty_terjual">Qty</label>
                        <div class="col-lg-10">
                            <input id="qty_terjual" name="qty_terjual" type="number" class="form-control" value="<?= $r[qty_terjual] ?>" required>
                        </div>
                    </div>

                </section>
                <input  name="id_transaksi" type="hidden" value="<?= $r[id_transaksi] ?>">
                <!--/
                <div class="form-group row">
                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                </div> -->
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="submit" href="module.php?module=laporan_tabel">
                        Submit
                    </button>
                    <button type="reset" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>
                </div>

            </form>
        </div>
        </div>
        <hr>
        </div>
        </div>
        
        <?php
        break;
        
}
?>