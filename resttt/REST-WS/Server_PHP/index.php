<?php
$url_array = explode('/', $_SERVER['REQUEST_URI']);
//array_shift($url_array); // remove first value as it's empty
// remove 2nd, 3rd and 4rd array, because it's directory
array_shift($url_array); // 2nd = 'pbp'
array_shift($url_array); // 3rd = 'rest'
array_shift($url_array); // 3rd = 'Server_PHP'

// get the action (resource, collection)
$action = $url_array[0];
if($url_array[0]==""){
	// jika tidak ada resource yang dituju
	exit();
}
// get the method
$method = $_SERVER['REQUEST_METHOD'];


include "fungsi.php";
$data=array();
if($method=="GET"){
	if(!isset($url_array[1])){ // if parameter nim not exist
		$data = getAllMahasiswa();
	}else{
		$nim = $url_array[1];
		$data = getDetailMahasiswa($nim);
	}
}elseif($method=='POST'){
	// get post from client
	$jsonData = file_get_contents('php://input');
	$mahasiswa = json_decode($jsonData); // decode to object
	
	$status = insertMahasiswa($mahasiswa);
	$data = array('status'=>$status);
}elseif($method=='PUT'){
	// get put from client
	$jsonData = file_get_contents('php://input');
	$mahasiswa = json_decode($jsonData); // decode to object

	$nim = $url_array[1];
	$status = updateMahasiswa($nim, $mahasiswa);
	$data = array('status'=>$status);
}elseif($method=='DELETE'){
	$nim = $url_array[1];
	$status = deleteMahasiswa($nim);
	$data = array('status'=>$status);
}



// Set HTTP Response
header('HTTP/1.1 200 OK');
// Set HTTP Response Content Type
header('Content-Type: application/json; charset=utf-8');
// Print data
echo json_encode($data);

?>