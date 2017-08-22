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
		
		$nimlama=$_GET['nim'];
		
		$nim="";
		$nama="";
		$progdi="";

		// URL API
		$url = 'http://localhost/rest-ws/Server_PHP/mahasiswa/'.$nimlama;

		// if submit, EDIT DATA
		if(isset($_POST["nim"])){

			$client = curl_init();

			// get POST
			$nim=$_POST['nim'];
			$nama=$_POST['nama'];
			$progdi=$_POST['progdi'];

			$data = array("nim"=>$nim, "nama"=>$nama, "progdi"=>$progdi);
			$data = json_encode($data);
			$options = array(
			    CURLOPT_URL				=> $url, // Set URL of API
			    CURLOPT_CUSTOMREQUEST 	=> "PUT", // Set request method
			    CURLOPT_RETURNTRANSFER	=> true, // true, to return the transfer as a string
			    CURLOPT_POSTFIELDS 		=> $data, // Send the data in HTTP POST
			    );

			curl_setopt_array( $client, $options );

			// Execute and Get the response
			$response = json_decode(curl_exec($client));
			// Close cURL session
			curl_close($client);
			echo "<div class='alert alert-success' style='width:300px;'>Berhasi Diedit</div>";
			header( "refresh:1;url=index.php");

		}else{

			// Load Data
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
			
			$data=json_decode($response);
			$nim=$data->nim;
			$nama=$data->nama;
			$progdi=$data->progdi;

		}

		?>


		<h1>Edit Mahasiswa</h1>
		<br/>
		<div style="width:300px;">
			<form role="form" method="POST">
				<div class="form-group">
					<label>NIM :</label>
					<input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>"/>
				</div>
				<div class="form-group">
					<label>Nama :</label>
					<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>"/>
				</div>
				<div class="form-group">
					<label>Progdi :</label>
					<input type="text" class="form-control" name="progdi" value="<?php echo $progdi; ?>"/>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Simpan">
					<a class="btn btn-default" href="index.php">Batal</a>
				</div>
			</form>
		</div>

	</div>

</body>
</html>