<?php
// Create connection
function getDB() {
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "pbf_siasat";

	$dbConnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}

function getAllMahasiswa()
{
	$db = getDB();
	try{
		$result = array();
		$query = "SELECT * FROM tb_mahasiswa";
		$stmt = $db->prepare($query); 
		$stmt->execute();
		$rs = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $rs;	
	} catch(PDOException $e) {
		return $e;
	}
}

function getDetailMahasiswa($nim)
{
	try{
		$db = getDB();
		$result = array();
		$query = "SELECT * FROM tb_mahasiswa WHERE nim = :nim";
		$stmt = $db->prepare($query); 
		$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);
		$stmt->execute();
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		return $rs;
	} catch(PDOException $e) {
		return $e;
	}
}

function searchMahasiswa($nama)
{
	$hasil = array();
	try{
		$db = getDB();
		$result = array();
		$query = "SELECT * FROM tb_mahasiswa WHERE nama LIKE :nama";
		$stmt = $db->prepare($query); 
		$stmt->bindValue(':nama', '%'.$nama.'%', PDO::PARAM_STR);
		$stmt->execute();
		$rs = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $rs;
	} catch(PDOException $e) {
		return $e;
	}
}

function insertMahasiswa($mhs){
	try{
		$db = getDB();
		$query = "INSERT INTO tb_mahasiswa VALUES (:nim, :nama, :progdi)";
		$stmt = $db->prepare($query); 
		$stmt->bindValue(':nim', $mhs->nim, PDO::PARAM_INT);
		$stmt->bindValue(':nama', $mhs->nama, PDO::PARAM_STR);
		$stmt->bindValue(':progdi', $mhs->progdi, PDO::PARAM_STR);
		$stmt->execute();
		return "success";
	} catch(PDOException $e) {
		return $e;
	}
}

function updateMahasiswa($nimlama, $mhs){
	try{
		$db = getDB();
		$query = "UPDATE tb_mahasiswa SET nim=:nim, nama=:nama, progdi=:progdi WHERE nim=:nimlama";
		$stmt = $db->prepare($query); 
		$stmt->bindValue(':nim', $mhs->nim, PDO::PARAM_INT);
		$stmt->bindValue(':nama', $mhs->nama, PDO::PARAM_STR);
		$stmt->bindValue(':progdi', $mhs->progdi, PDO::PARAM_STR);
		$stmt->bindValue(':nimlama', $nimlama, PDO::PARAM_INT);
		$stmt->execute();
		return "success";
	} catch(PDOException $e) {
		return $e;
	}
}

function deleteMahasiswa($nim)
{
	try{
		$db = getDB();
		$query = "DELETE FROM tb_mahasiswa WHERE nim=:nim";
		$stmt = $db->prepare($query); 
		$stmt->bindValue(':nim', $nim, PDO::PARAM_INT);
		$stmt->execute();
		return "success";
	} catch(PDOException $e) {
		return $e;
	}
}

?>