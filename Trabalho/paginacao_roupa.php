<?php
	include("conexao.php");

	if(!isset($_SESSION["autorizado"])){
		session_start();
	}

	$select = "SELECT * FROM roupa WHERE CNPJ='".$_SESSION["autorizado"]."'";

	if(!(empty($_GET))){
		$nome = $_GET["nome_filtro"];
		$select .= " AND marca LIKE '%$nome%'";
	}
	
	$resultado = mysqli_query($conexao, $select);
	
	$linha = mysqli_num_rows($resultado);
	
	$qtd_pagina = (int) ($linha/2);
	
	if($linha%2 != 0){
		$qtd_pagina++;
		$qtd_pagina = (int)$qtd_pagina;
	}
	
	echo '<nav aria-label = "Navegação de página exemplo">
			<ul class = "pagination justify-content-center">';
	
	for($i=1;$i<=$qtd_pagina;$i++){
		echo "<li class = 'page-item'><a name = 'btn_pagina' class = 'page-link bg-dark text-white'>$i</a></li>";
	}
	
	echo '	</ul>
		  </nav>';
?>