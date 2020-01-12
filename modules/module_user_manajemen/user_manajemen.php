<?php
$aksi = "modules/module_user_manajemen/aksi_user_manajemen.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">USER MANAJEMEN</h4>
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
                                    <a type="button" href='?module=user_manajemen&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Akun</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">USER MANAJEMEN</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>	
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Nomor Tlp</th>
                                    <th>Level</th>
                                    <th style="width: 20px" >Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM user_akun "
                                        ."ORDER BY id_user_akun ASC");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[username] ?></td>
                                        <td><?= $r[nama] ?></td>
                                        <td><?= $r[alamat] ?></td>
                                        <th><?= $r[email] ?></th>
                                        <th><?= $r[nomr_tlp] ?></th>
                                        <th><?= $r[level] ?></th>

                                        <td>
                                            <a type="button" href='?module=user_manajemen&act=edit&id=<?= $r[id_user_akun] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=user_manajemen&act=hapus&id=<?= $r[id_user_akun] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="page-title">TAMBAH AKUN</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=user_manajemen&act=input'>
                                <h3>Account</h3>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nama">Nama</label>
                                        <div class="col-lg-10">
                                            <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukan Nama" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="alamat">Alamat</label>
                                        <div class="col-lg-10">
                                            <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukan Alamat" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="email">Email</label>
                                        <div class="col-lg-10">
                                            <input  id="email" name="email" type="email" class="form-control" placeholder="Masukan Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nomr_tlp">Nomor Tlp</label>
                                        <div class="col-lg-10">
                                            <input id="nomr_tlp" name="nomr_tlp" type="text" class="form-control" placeholder="Masukan Nomor Tlp" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="username">Username</label>
                                        <div class="col-lg-10">
                                            <input id="username" name="username" type="text" class="form-control" placeholder="Masukan Username" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="password">Password</label>
                                        <div class="col-lg-10">
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Masukan Password" required>
                                        </div>
                                    </div>
                                   
                                    
                                    <!-- radio button-->
                                    <div class="form-group row ">
                                        <label class="col-lg-2  text-left">Level</label>
                                        <div class="col-lg-10">
                                            <div class="radio radio-info">
                                                <input type="radio" name="level" id="radio1" value="admin" checked="">
                                                <label for="radio1">
                                                    admin
                                                </label>
                                            </div>
                                            <div class="radio radio-info">
                                                <input type="radio" name="level" id="radio2" value="manajer" checked="">
                                                <label for="radio2">
                                                    manajer
                                                </label>
                                            </div>  
                                        </div>  
                                    </div>
                                    <!-- /radio button-->

                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="button" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
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
        $edit = mysql_query("SELECT * FROM user_akun WHERE id_user_akun='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>

        <!-- end row -->
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH AKUN</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=user_manajemen&act=update'>
                                <h3>Account</h3>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nama">Nama</label>
                                        <div class="col-lg-10">
                                            <input id="nama" name="nama" type="text" class="form-control" value="<?= $r[nama] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="alamat">Alamat</label>
                                        <div class="col-lg-10">
                                            <input id="alamat" name="alamat" type="text" class="form-control" value="<?= $r[alamat] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="email">Email</label>
                                        <div class="col-lg-10">
                                            <input  id="email" name="email" type="email" class="form-control" value="<?= $r[email] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nomr_tlp">Nomor Tlp</label>
                                        <div class="col-lg-10">
                                            <input id="nomr_tlp" name="nomr_tlp" type="text" class="form-control" value="<?= $r[nomr_tlp] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="username">Username</label>
                                        <div class="col-lg-10">
                                            <input id="username" name="username" type="text" class="form-control" value="<?= $r[username] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="password">Password</label>
                                        <div class="col-lg-10">
                                            <input id="password" name="password" type="password" class="form-control" value="" placeholder="********">
                                        </div>
                                    </div>

                                    <!-- radio button-->
                                    <div class="form-group row ">
                                        <label class="col-lg-2  text-left">Level</label>
                                        <div class="col-lg-10">
                                            <div class="radio radio-info">
                                                <input type="radio" name="level" id="radio1" value="admin"  <?=$r[level]=='admin'?'checked':NULL?>>
                                                <label for="radio1">
                                                    admin
                                                </label>
                                            </div>
                                            <div class="radio radio-info">
                                                <input type="radio" name="level" id="radio2" value="manajer" <?=$r[level]=='manajer'?'checked':NULL?>>
                                                <label for="radio2">
                                                    manajer
                                                </label>
                                            </div>  
                                        </div>  
                                    </div>
                                    <!-- /radio button-->                               

                                </section>

                                <input  name="id_user_akun" type="hidden" value="<?= $r[id_user_akun] ?>">

                                <!--/ <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Wajib DI Isi</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="button" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
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