<?php
//memasukkan file koneksi
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mesin Pencari Hazel</title>
</head>
<body>
	
 <center>
 	<h1>Selamat Datang Di Mesin Pencari Hazel!</h1>
	<form action="" method="post">
		<input type="text" size="90" name="judul" placeholder="Masukkan Kata Pencarian" /></br></br>	
		<input type="submit" name="submit" value="Cari!" />

	<h4>Mau artikel anda terindex mesin pencari hazel? kunjungi http://hazelseach.freewebhosting.com.bd/regestrasi/reg_artikel.php</h4>

	<h4>Copyright 2021 hazel.</h4>
 </center>
	
	<?php
	//jika tombol Cari di klik akan menjalankan script berikutnya
	if(isset($_POST['submit'])){
		//membuat variabel $kata_kunci yang menyimpan data dari inputan kata kunci
		$pencarian = $koneksi->real_escape_string(htmlentities(trim($_POST['judul'])));
		
		//cek apakah kata kunci kurang dari 3 karakter
		if(strlen($pencarian)<3){
			//pesan error jika kata kunci kurang dari 3 karakter
			echo '<p>Kata kunci terlalu pendek.</p>';
		}else{
			//membuat variabel $where dengan nilai kosong
			$where = "";
			
			//membuat variabel $kata_kunci_split untuk memecah kata kunci setiap ada spasi
			$pencarian_split = preg_split('/[\s]+/', $pencarian);
			//menghitung jumlah kata kunci dari split di atas
			$total_pencarian = count($pencarian_split);
			
			//melakukan perulangan sebanyak kata kunci yang di masukkan
			foreach($pencarian_split as $key=>$kunci){
				//set variabel $where untuk query nanti
				$where .= "judul LIKE '%$kunci%'";
				//jika kata kunci lebih dari 1 (2 dan seterusnya) maka di tambahkan OR di perulangannya
				if($key != ($total_pencarian - 1)){
					$where .= " OR ";
				}
			}
			
			//melakukan query ke database dengan SELECT, dan dimana WHERE ini mengambil dari $where
			$results = $koneksi->query("SELECT judul, LEFT(deskripsi, 60) as deskripsi, url FROM artikel WHERE $where");
			//menghitung jumlah hasil query di atas
			$num = $results->num_rows;
			//jika tidak ada hasil
			if($num == 0){
				//pesan jika tidak ada hasil
				echo '<p>Pencarian dengan <b>'.$pencarian.'</b> tidak ada hasil.</p>';
			}else{
				//pesan jika ada hasil pencarian
				echo '<p>Pencarian dengan <b>'.$pencarian.'</b> mendapatkan '.$num.' hasil:</p>';
				//perulangan untuk menampilkan data
				while($row = $results->fetch_assoc()){
					//menampilkan data
					echo '
					<p>
						<b>'.$row['judul'].'</b><br>
						'.$row['deskripsi'].'...<br>
						<a href="'.$row['url'].'">'.$row['url'].'</a>
					</p>
					';
				}
			}
		}
	}
	?>
	
</body>
</html>