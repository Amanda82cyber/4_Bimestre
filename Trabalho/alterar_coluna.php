<?php
	include("conexao.php");
	
	
	$id = $_POST["id"];

	if(isset($_FILES["foto_alterar"])){
		$foto = $_FILES["foto_alterar"];
		if (!empty($foto["name"])) {
 
			$error = array();
	 
			// Verifica se o arquivo é uma imagem
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
				$error[1] = "Isso não é uma imagem.";
				} 
	 
			// Se não houver nenhum erro
			if (count($error) == 0) {
			
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	 
				// Gera um nome único para a imagem
				$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	 
				// Caminho de onde ficará a imagem
				$caminho_imagem = "fotos/" . $nome_imagem;
	 
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			}

			$update = "UPDATE roupa SET foto = '$nome_imagem' WHERE id_roupa = $id";
			mysqli_query($conexao, $update) or die("0" .mysqli_error($conexao));
			echo $nome_imagem;
		}
	}
	else{
		$coluna = $_POST["coluna"];
		$valor = $_POST["valor"];
		$update = "UPDATE roupa SET $coluna = '$valor' WHERE id_roupa = $id";
		mysqli_query($conexao, $update) or die("0" .mysqli_error($conexao));
		echo "1";
	}
	
	
?> 