<?php 
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}

// echo"<pre>";
// print_r($datakategori);
// echo "</pre>";
 ?>


<h2><center>Tambah Produk</center></h2>
<br>	<br>	
<form method="post" enctype="multipart/form-data">
	<div class="from-group">
		<label>nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label > kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>
				<option value="<?php echo $value['id_kategori'] ?>"><?php echo $value['nama_kategori'] ?></option>
			<?php endforeach ?>
		</select>
<!-- 		<pre><?php print_r($datakategori); ?> </pre> -->
	</div>
	<div class="from-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	
	<div class="from-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="from-group">
		<label>Foto</label>
		<div class="letak-input" style="margin-bottom: 10px;">
			<input type="file" class="form-control" name="foto[]">
		</div>
		
	</div>
	<div class="from-group">
		<label>Stok Produk</label>
		<input type="number" class="form-control" name="stok_produk">
	</div>
	<br>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
	if (isset($_POST['save'])) 
	{
		$namanamafoto = $_FILES['foto']['name'];
		$lokasilokasifoto = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasilokasifoto[0], "../foto_produk/".$namanamafoto[0]);
		$koneksi->query("INSERT INTO produk
			(nama_produk,harga_produk,foto_produk,deskripsi_produk,stok_produk,id_kategori) 
			VALUES('$_POST[nama]','$_POST[harga]','$namanamafoto[0]','$_POST[deskripsi]','$_POST[stok_produk]','$_POST[id_kategori]') ");

		//mendapatkan id_produk barusan
		$id_produk_barusan = $koneksi->insert_id;

		foreach ($namanamafoto as $key => $tiap_nama) 
		{
			$tiap_lokasi = $lokasilokasifoto[$key];

			move_uploaded_file($tiap_lokasi, "../foto_produk/".$tiap_nama);

			// simpan ke mysql (tapi kita perlu tau id_produknya berapa?)
			$koneksi->query("INSERT INTO foto_produk (id_produk,nama_produk,foto_produk)
				VALUES('$id_produk_barusan','$tiap_nama')");
		}


		echo "<div class='alert alert-info'>Data tersimpan</div>";
 		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";

 	
	}
 ?>