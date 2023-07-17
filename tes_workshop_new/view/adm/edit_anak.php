<?php 
    $id_anak = mysqli_real_escape_string($conn, $_GET['id_anak']);
    $sql_ank = "SELECT*FROM detail_user NATURAL LEFT JOIN user WHERE id_user= '$id_anak'";
    if ($get_ank = $conn->query($sql_ank)->fetch_assoc()) {
    extract($get_ank);
    ?>
    <form class="form-horizontal" role="form" style="width:80%" onSubmit="return validasi()" name="formulir" method="post" action="./model/proses.php">
  <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Kode:</label>
    <div class="col-sm-10">
      <input type="number" value="<?php echo $kode_user; ?>" class="form-control" name="kode" placeholder="Masukan Kode" required>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Nama Lengkap:</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $name_user; ?>" class="form-control" name="nama" placeholder="Masukan Nama Lengkap" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="jk">Jenis Kelamin:</label>
    <div class="col-sm-10">
        <?php 
        $jk = array("Laki-laki","Perempuan");
        $jk_vl = array("L","P");
        $sum = count($jk_vl)-1;
        for ($i=0; $i<= $sum ; $i++) { 
            if ($jk_user == "$jk_vl[$i]") {
                $checked = "checked";
            } else {
                $checked = "";
            }
            echo '<label class="radio-inline"><input type="radio" name="jk" id="jk" value="'.$jk_vl[$i].'" '.$checked.'>'.$jk[$i].'</label>';
        }
         ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="alamat">Alamat:</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $alamat_user; ?>" class="form-control" name="alamat" placeholder="Masukan Alamat" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <strong><?php echo $email_user; ?></strong>
    </div>
  </div>
  <div class="form-group">
  <fieldset>
    <label class="control-label col-sm-2">Katasandi:</label>
    <div class="col-sm-10"> 
    <a href="katasandi&id=<?php echo $id_user; ?>">Ubah katasandi</a>
    </div>
    </fieldset>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="edit_anak">Simpan</button>
      <button type="button" onclick="hapusAnak(<?php echo $id_user; ?>)" class="btn btn-danger" name="">Hapus Anak</button>
    </div>
  </div>
</form>
<?php
} else {
    echo "Data tidak ditemukan";
}
 ?>
 