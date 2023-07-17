<ul class="nav nav-sidebar">
<li id="output"></li>
   <?php
   		if (isset($_SESSION['adm'])) {
   			$link=array("","add_anak","anak","absen","absensi", "katasandi&id=$_SESSION[id]","keluar");
			$name=array("","Tambah Anak","Daftar Anak","Absen","Lihat Absensi","Ubah Katasandi", "Keluar");

			for ($i=1; $i <= count($link)-1 ; $i++) {
				if (strcmp($page, "$link[$i]")==0) {
			        $status = "class='active'";
			      } else {
			      	$status = "";
			      }
				echo "<li $status><a href='$link[$i]'>$name[$i]</a></li>";
			}
   		} elseif (isset($_SESSION['ank'])) {
   			$this_day = date("d");
			$sql = "SELECT*FROM data_absen NATURAL LEFT JOIN tanggal WHERE nama_tgl='$this_day' AND id_user='$_SESSION[id]'";
			$query = $conn->query($sql);

			$query_tday = $query->fetch_assoc();


			$link=array("","absen","keluar");
			$name=array("","Absen","Keluar");
			
			for ($i=1; $i <= count($link)-1 ; $i++) {
				if (strcmp($page, "$link[$i]")==0) {
			        $status = "class='active'";
			      } else {
			      	$status = "";
			      }
			    if ($query->num_rows==0 && $link[$i]==="absen") {
					$warning = "<img src='./lib/img/warning.png' width='20' />";
				} else {
					$warning = "";
				}
				echo "<li $status><a href='$link[$i]'>$name[$i] $warning</a></li>";
			}
   		}
	?>
</ul>