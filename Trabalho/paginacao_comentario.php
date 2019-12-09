<?php
	include("conexao.php");
	
	$select = "SELECT * 
			   FROM comentario
			   INNER JOIN roupa 
			   ON roupa.id_roupa = comentario.id_roupa
			   AND comentario.id_roupa = $id";
	
	$resultado = mysqli_query($conexao, $select);
	
	$linha = mysqli_num_rows($resultado);
	
	$qtd_pagina = $linha/6;
	
	if($linha%6 != 0){
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