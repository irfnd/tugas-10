<?php include("server.php"); ?>
<?php $result = mysqli_query($db, "SELECT * FROM produk"); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM produk WHERE id=$id");

		if (count(array($record)) == 1 ) {
			$n = mysqli_fetch_array($record);
			$nama_produk = $n['nama_produk'];
			$keterangan = $n['keterangan'];
			$harga = $n['harga'];
			$jumlah = $n['jumlah'];
		}
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Produkku</title>
	<style>
		table, th, td {
			border: solid 1px #000;
			text-align: left;
		}
	</style>
</head>
<body>

	<!-- Alert jika CRUD data -->
	<?php if (isset($_SESSION['alert'])) : ?>
	<h2>
		<?php
			echo $_SESSION['alert'];
			unset($_SESSION['alert']);
		?>
	</h2>
	<?php endif ?>

	<!-- Form CRUD data -->
	<form action="server.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="text" name="nama-produk" placeholder="Masukan nama produk" value="<?php echo $nama_produk; ?>"><br>
		<input type="text" name="harga" placeholder="Masukan harga" value="<?php echo $harga; ?>"><br>
		<input type="text" name="jumlah" placeholder="Masukan jumlah" value="<?php echo $jumlah; ?>"><br>
		<textarea name="keterangan" rows="3" placeholder="Masukan keterangan"><?php echo $keterangan; ?></textarea><br>
		<?php if ($update == true): ?>
		<input type="submit" name="update" value="Update">
		<?php else: ?>
		<input type="submit" name="save" value="Save">
		<?php endif ?>
	</form>

	<!-- Table data -->
	<table>
		<thead>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Keterangan</th>
			<th colspan="2">Aksi</th>
		</thead>
		<?php while ($row = mysqli_fetch_array($result)) { ?>
		<tr>
			<td><?php echo $row['nama_produk']; ?></td>
			<td><?php echo "Rp. ".$row['harga']; ?></td>
			<td><?php echo $row['jumlah']; ?></td>
			<td><?php echo $row['keterangan']; ?></td>
			<td><a href="index.php?edit=<?php echo $row['id'] ?>">Edit</a></td>
			<td><a href="server.php?del=<?php echo $row['id'] ?>">Delete</a></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>