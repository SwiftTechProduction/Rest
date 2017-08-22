
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

		$nim = $_GET['nim']; // id that will delete
		// URL API
		$url = 'http://localhost/rest-ws/Server_PHP/mahasiswa/'.$nim;

		$client = curl_init();

		$options = array(
		    CURLOPT_URL				=> $url, // Set URL of API
		    CURLOPT_CUSTOMREQUEST 	=> "DELETE", // Set request method
		    CURLOPT_RETURNTRANSFER	=> true, // true, to return the transfer as a string
		    );

		curl_setopt_array( $client, $options );

		// Execute and Get the response
		$response = json_decode(curl_exec($client));
		// Close cURL session
		curl_close($client);

		echo "<div class='alert alert-success' style='width:300px;'>Berhasi Dihapus</div>";
		header( "refresh:1;url=index.php");
		
		?>

	</div>

</body>
</html>