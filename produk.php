<section id="highlights " class="highlights scrollspy" >
	<div class="container">
		<h1 class="center-align" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Katalog Petualangan</h1>
		<div class="row">
			<?php 	$ambil = $koneksi->query('SELECT * FROM produk'); ?>
			<?php 	while($perproduk = $ambil->fetch_assoc()){ ?>	
				<div class="grid-example col m3 s12" >
					<div class=" responisve-card card hoverable">
						<div class="card-image waves-effect waves-block waves-light">
							<center>
								<img class="responsive-img activator" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" style="height: 200px; width: 250px;" id="gambarr">
							</center>
							<span class="card-title">
								<strong style="font-family: poppins;"><p><?php echo $perproduk['nama_produk']; ?></p></strong>
							</div>
							<div class="card-content">
								<p>Sisa Kuota : <?php echo $perproduk['stok_produk'] ?></p>
								<span class="harga">
									<h5>Rp.<?php echo number_format($perproduk['harga_produk']); ?></h5>
								</span> 
								<hr>
								<div class="card-action" style="margin-bottom:20px;">
									<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" 
									class="btn waves-effect waves-light left red btn-small ">Detail</a>
									<a href="beli.php?id=<?php 	echo $perproduk['id_produk']; ?>" 
									class="btn waves-effect waves-light right btn-small">beli</a></span>
								</div>
							</div>
						</div>
					</div>
				<?php 	} ?>
			</div>	
		</div>
	</section>
