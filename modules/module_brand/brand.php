<?php
$aksi = "modules/module_brand/aksi_brand.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TANAMAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right m-t-15">
                                    <a type="button" href='?module=brand&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Tanaman</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA TANAMAN</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Nama Tanaman</th>										
<!--                                    <th>Alamat Brand</th>
                                    <th>Email</th>
                                    <th>Nomor Tlp</th>-->
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[nama_brand] ?></td>
<!--                                        <th><? $r[alamat_brand] ?></th>
                                        <td><? $r[email] ?></td>
                                        <td><? $r[nomr_tlp] ?></td>-->
                                        <td>
                                            <a type="button" href='?module=brand&act=edit&id=<?= $r[id_brand] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?=$aksi?>?module=brand&act=hapus&id=<?=$r[id_brand]?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
        </div>
        <?php
        break;

    // Form Tambah 
    case "tambah":
        ?>
        <!-- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH TANAMAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-12">
                <div class="card-box">

                    <div class="col-lg-12">

                        <hr>

                        <div class="p-20">
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=brand&act=input'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="nama_brand">Nama Tanaman</label>
                                        <div class="col-lg-10">
                                            <input id="nama_brand" name="nama_brand" type="text" class="form-control" placeholder="Masukan Nama Tanaman" required>
                                        </div>
                                    </div>

<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="alamat_brand">Alamat Brand</label>
                                        <div class="col-lg-10">
                                            <input id="alamat_brand" name="alamat_brand" type="text" class="form-control" placeholder="Masukan Alamat Brand" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="email">Email</label>
                                        <div class="col-lg-10">
                                            <input id="email" name="email" type="email" class="form-control" placeholder="Masukan Email" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nomr_tlp">Nomor Tlp</label>
                                        <div class="col-lg-10">
                                            <input id="nomr_tlp" name="nomr_tlp" type="text" class="form-control" placeholder="Masukan Nomor Tlp" required>
                                        </div>
                                    </div>-->
                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="button"  onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <!-- end row -->

        <?php
        break;

    // Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM brand WHERE id_brand='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>


        <!-- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH TANAMAN</h4>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-12">
                <div class="card-box">

                    <div class="col-lg-12">

                        <hr>

                        <div class="p-20">
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=brand&act=update'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="nama_brand">Nama Tanaman</label>
                                        <div class="col-lg-10">
                                            <input id="nama_brand" name="nama_brand" type="text" class="form-control" value="<?= $r[nama_brand] ?>" required>
                                        </div>
                                    </div>

<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="alamat_brand">Alamat Brand</label>
                                        <div class="col-lg-10">
                                            <input id="alamat_brand" name="alamat_brand" type="text" class="form-control"  value="<? $r[alamat_brand] ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="email">Email</label>
                                        <div class="col-lg-10">
                                            <input id="email" name="email" type="email" class="form-control"  value="<? $r[email] ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nomr_tlp">Nomer Tlp</label>
                                        <div class="col-lg-10">
                                            <input id="nomr_tlp" name="nomr_tlp" type="text" class="form-control"  value="<? $r[nomr_tlp] ?>" required>
                                        </div>
                                    </div>-->

                                </section>

                                <input  name="id_brand" type="hidden" value="<?= $r[id_brand] ?>">
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="button"  onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <!-- end row -->


        <?php
        break;
}
?>