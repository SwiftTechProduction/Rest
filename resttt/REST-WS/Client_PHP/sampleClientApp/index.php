
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sample Client App</title>
	<link href="bootstrap-3.3.51/css/bootstrap.css" rel="stylesheet"/>
</head>

<body>

	<div class="container">
		<br/>

		<?php

		// URL API
		$url = 'http://localhost/rest-ws/Server_PHP/mahasiswa';
		$client = curl_init();
		$options = array(
	    CURLOPT_URL				=> $url, // Set URL of API
	    CURLOPT_CUSTOMREQUEST 	=> "GET", // Set request method
	    CURLOPT_RETURNTRANSFER	=> true, // true, to return the transfer as a string
	    );
		curl_setopt_array( $client, $options );

		// Execute and Get the response
		$response = curl_exec($client);
		// Close cURL session
		curl_close($client);

		$daftarMahasiswa=null;
		$daftarMahasiswa=json_decode($response);

		?>

		<h1>Data Mahasiswa</h1>
		<br/>
		<div class="col-sm-12">
			<a type="button" class="btn btn-primary" href="tambah.php">Tambah Mahasiswa</a>
		</div>
		<br/><br/>
		<table class="table" cellspacing="0" width="100%">
			<tr>
				<th>No.</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Progdi</th>
				<th>Action</th>
			</tr>
			<?php
			if($daftarMahasiswa!=null){
				$i=1;
				foreach($daftarMahasiswa as $mahasiswa){
					echo "<tr>";
					echo "<td>".$i++.".</td>";
					echo "<td>".$mahasiswa->nim."</td>";
					echo "<td>".$mahasiswa->nama."</td>";
					echo "<td>".$mahasiswa->progdi."</td>";
					echo "<td>";
					echo "<a class='btn btn-warning btn-sm' href='edit.php?nim=".$mahasiswa->nim."'>EDIT</a> ";
					echo "<a class='btn btn-danger btn-sm' href='hapus.php?nim=".$mahasiswa->nim."'>HAPUS</a> ";
					echo "</td>";
					echo "</tr>";
				}
			}
			?>
		</table>

	</div>
</body>
</html>