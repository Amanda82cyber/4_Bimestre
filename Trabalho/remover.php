<?php
	include("conexao.php");
	
	$id = $_POST["id_roupa"];
	
	$remocao = "DELETE FROM roupa WHERE id_roupa='$id'";
	
	// mysqli_error($conexao)
	mysqli_query($conexao,$remocao) or die("0".mysqli_error());
	
	echo "1";
?>