<?php
$aksi = "modules/module_jenis_kelamin/aksi_jenis_kelamin.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">JENIS KELAMIN</h4>
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
                                    <a type="button" href='?module=jenis_kelamin&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Jenis Kelamin</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA JENIS KELAMIN</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Jenis Kelamin</th>										
                                    <th>Kode Jenis Kelamin</th>
                                    <th style="width: 20px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM jenis_kelamin ORDER BY id_jenis_kelamin ASC");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[nama_jenis_kelamin] ?></td>
                                        <th><?= $r[kode_jenis_kelamin] ?></th>
                                        <td>
                                            <a type="button" href='?module=jenis_kelamin&act=edit&id=<?= $r[id_jenis_kelamin] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=jenis_kelamin&act=hapus&id=<?= $r[id_jenis_kelamin] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="page-title">TAMBAH JENIS KELAMIN</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=jenis_kelamin&act=input'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="nama_jenis_kelamin">Jenis kelamin</label>
                                        <div class="col-lg-10">
                                            <input id="nama_jenis_kelamin" name="nama_jenis_kelamin" type="text" class="form-control" placeholder="Masukan Jenis kelamin" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="kode_jenis_kelamin">Kode Jenis Kelamin</label>
                                        <div class="col-lg-10">
                                            <input id="kode_jenis_kelamin" name="kode_jenis_kelamin" type="text" class="form-control" placeholder="Masukan Kode Jenis Kelamin" required>
                                        </div>
                                    </div>
                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
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
        </div>
        <!-- end row -->

        <?php
        break;

// Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM jenis_kelamin WHERE id_jenis_kelamin='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH JENIS KELAMIN</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=jenis_kelamin&act=update'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="nama_jenis_kelamin">Jenis kelamin</label>
                                        <div class="col-lg-10">
                                            <input id="nama_jenis_kelamin" name="nama_jenis_kelamin" type="text" class="form-control" value="<?= $r[nama_jenis_kelamin] ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="kode_jenis_kelamin">Kode Jenis Kelamin</label>
                                        <div class="col-lg-10">
                                            <input id="kode_jenis_kelamin" name="kode_jenis_kelamin" type="text" class="form-control" value="<?= $r[kode_jenis_kelamin] ?>" required>
                                        </div>
                                    </div>
                                </section>

                                <input  name="id_jenis_kelamin" type="hidden" value="<?= $r[id_jenis_kelamin] ?>">
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
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
        </div>
        <!-- end row -->

        <?php
        break;
}
?>
