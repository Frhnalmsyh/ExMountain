<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
// mendapatkan id produk dari url
$id_produk = $_GET["id"];

	// query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); 
$detail =$ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail | ExMountain</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- My Css -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" type="text/css" href="favicon.jpg"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<!--Navbar-->
	<?php include "navbar.php" ?>
	<div class="container">
		<h1 class="center-align" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Detail Trip</h1>
		<div class="row">
			<div class="grid-example col m4 s12">
				<center><img class="responsive-img activator" src="foto_produk/<?php echo $detail['foto_produk']; ?>" style="height: 300px; width: 350px;" id="gambarr"></center>
			</div>
			<div class="grid-example col m6 s12">
				<h5><?php echo $detail['nama_produk']; ?></h5>
				<h6>Rp.<?php echo number_format($detail['harga_produk']); ?></h6>
				<h7>Sisa Kuota : <?php echo $detail['stok_produk']; ?></h7>
				<div class="row">
					<form class="col s12" method="post">
						<div class="row">
							<div class="input-field col s6">
								<input placeholder="Jumlah" min="1" max="<?php echo $detail["stok_produk"]; ?>" type="number" class="form-control" name="jumlah" >
							</div>
							<div class="input-field col s6 right-align">
								<button class="btn" name="beli" style="background-color:#074A2A; border-radius:8px;">beli</button>
							</div>
						</div>
						<h7><?php echo $detail['deskripsi_produk']?></h7>
					</form>
					<?php 
					if (isset($_POST["beli"])) {
								// mendapatkan id produk yang kita beli
						$jumlah = $_POST["jumlah"];
								// masukkan di keranjang belanja
						$_SESSION["keranjang"][$id_produk] = $jumlah;

						echo "<script>alert('produk telah masuk ke keranjang')</script>";
						echo "<script>location='keranjang.php';</script>";
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<br>

</body>
<!-- footer -->
<?php include"footer.php" ;?>
</html>





