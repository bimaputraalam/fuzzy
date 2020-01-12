<?php
$aksi = "modules/module_warna/aksi_warna.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="page-title">WARNA</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <!--- end row -->


        <div class="row">
           
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right m-t-15">
                                    <a type="button" href='?module=warna&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Warna</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA WARNA</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Warna</th>										
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM warna ORDER BY id_warna ASC");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[nama_warna] ?></td>
                                        <td>
                                            <a type="button" href='?module=warna&act=edit&id=<?= $r[id_warna] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=warna&act=hapus&id=<?= $r[id_warna] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="page-title">TAMBAH WARNA</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=warna&act=input'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="nama_warna">Warna</label>
                                        <div class="col-lg-10">
                                            <input id="nama_warna" name="nama_warna" type="text" class="form-control" placeholder="Masukan Warna" required>
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
        $edit = mysql_query("SELECT * FROM warna WHERE id_warna='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH WARNA</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=warna&act=update'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="nama_warna">Warna</label>
                                        <div class="col-lg-10">
                                            <input id="nama_warna" name="nama_warna" type="text" class="form-control" value="<?= $r[nama_warna] ?>" required>
                                        </div>
                                    </div>
                                </section>
                                
                                <input  name="id_warna" type="hidden" value="<?= $r[id_warna] ?>">
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
