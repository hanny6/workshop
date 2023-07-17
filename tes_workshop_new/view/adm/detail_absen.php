<h3 class='page-header'>Detail Absensi Anak PPA</h3>
	<div class='table-responsive'>
	<?php 
		if (isset($_GET['id_anak'])) {
			if ($_GET['id_anak']!=="") {
				$id_user=$_GET['id_anak'];
				include './view/detail_absen.php';
			} else {
				header("location:absensi");
			}
		} else {
			$sql = "SELECT*FROM detail_user ORDER BY alamat_user ASC";
			$query = $conn->query($sql);
			if ($query->num_rows!==0) {
				echo "<table class='table table-striped' style='width:50%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Anak</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>";
				$no=0;
				while ($get_anak = $query->fetch_assoc()) {
					$id_anak = $get_anak['id_user'];
					$name = $get_anak['name_user'];
					$address = $get_anak['alamat_user'];
					$no++;
					echo "<tr>
							<td>$no</td>
							<td>$name</td>
							<td>$address</td>
							<td><a href='absensi&id_anak=$id_anak' title='Absensi $name'>Lihat Absensi</a></td>
						</tr>";
				}
				echo "</tbody></table>";
				$conn->close();
			} else {
				echo "<div class='alert alert-danger'><strong>Tidak ada Anak untuk ditampilkan</strong></div>";
			}
		}
	 ?>
</div>