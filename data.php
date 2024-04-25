<?php
	require 'DbConnect.php';
	if(isset($_POST['aid'])) {
		$db = new DbConnect;
		$conn = $db->connect();
    $string = implode('|',$_POST);
		$stmt = $conn->prepare("SELECT * FROM unidade WHERE cnpj = '$string' ");
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($books);
	}
	function loadAuthors() {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM empresa");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}
 ?>
