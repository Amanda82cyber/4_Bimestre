<?php
	header("Content-Type: Application/json");
	
	include("conexao.php");

	session_start();
	
	$p = $_GET["pagina"];
	$c = $_SESSION["autorizado"];
	
	$consulta = "SELECT marca, 
						id_roupa,
						l.CNPJ as CNPJ,
						tamanho, 
						preco, 
						cor, 
						tipo, 
						material, 
						quantidade, 
						l.nome as nome_loja, 
						genero, 
						foto, 
						ano_lancamento
				 FROM roupa r
				 INNER JOIN loja l
				 ON l.CNPJ = r.CNPJ
				 WHERE $c = r.CNPJ";

	if(isset($_GET["nome_filtro"])){
		$nome = $_GET["nome_filtro"];
		$consulta .= " AND marca LIKE '%$nome%'";
	}

	$consulta .= " ORDER BY marca LIMIT $p, 2";
	
	$resultado = mysqli_query($conexao,$consulta) or die("0" .mysqli_error($conexao));
	
	while($linha = mysqli_fetch_assoc($resultado)){
		$matriz["roupa"][] = $linha;
	}
	
	echo json_encode($matriz);
?>