<?php
	include("conexao.php");
	
	$CPF = $_SESSION["autorizado"];
	
	$select = "SELECT * 
			   FROM comprar c
			   INNER JOIN roupa r
			   ON c.id_roupa = r.id_roupa
			   INNER JOIN usuario u
			   ON c.CPF = u.CPF
			   WHERE c.CPF = $CPF";

	if(isset($_GET["nome_filtro"])){
		$nome = $_GET["nome_filtro"];
		$select .= " AND r.marca LIKE '%$nome%'";
	}
	
	$resultado = mysqli_query($conexao, $select);
	
	$linha = mysqli_num_rows($resultado);
	
	$qtd_pagina = $linha/3;
	
	if($linha%3 != 0){
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