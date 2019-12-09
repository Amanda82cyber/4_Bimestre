<?php
	include("menu.php");
?>
	<script>
		$(document).ready(function(){
			carrega_coment(0);
			$("#postar").click(function(){
				if(($("#coment").val()) != ""){
					$.ajax({
						url: "inserir_comentario.php",
						type: "post",
						data: {cpf:$("#CPF").val(), id_roupa:$("#id_roupa").val(), coment:$("textarea[name = 'coment']").val()},
						
						beforeSend:function(){
							$("#a").html("Inserindo comentário...");
							$("#a").css("color","secondary");
						},
						
						success:function(data){
							if(data==1){
								$("#a").html("Comentário inserido com sucesso!");
								$("#a").css("color", "green");
								$("#coment").val("");
								carrega_coment(0);
							}else{
								$("#a").html("Erro ao inserir comentário!");
								$("#a").css("color", "red");
							}
						},
						
						error:function(e){
							$("#a").html("Sistema em manutenção. Tente novamente mais tarde!" + e);
							$("#a").css("color", "red");
						}
					});
				}else{
					alert("Insira algo no campo!!!");
				}	
			});
			
			function carrega_coment(pg){
				$.ajax({
					url: "listar_coment.php",
					type: "get",
					data: {pagina: pg, id_roupa: $("#id_roupa").val()},
					success: function(matriz){
						$("#meus_coment").html("");
						for(i=0;i<matriz["coment"].length; i++){
							nome = matriz["coment"][i].nome_usuario;
							if(matriz["coment"][i].CPF == "NULL"){
								nome = "Anônimo";
							}
							list = "<div class = 'col-4'><div class = 'border w-100 rounded mb-2'><table class = 'table table-borderless'>";
							list += "<thead>";
							list += "<tr><th>" + nome + " - " + matriz["coment"][i].data + " , " + matriz["coment"][i].hora +"</th></tr>";
							list += "</thead>";
							list += "<tbody>";
							list += "<tr><td>" + matriz["coment"][i].comentario + "</td></tr>";
							list += "</tbody>";
							list += "<tfoot>";
							list += "<tr><td class = 'text-black-50'>" + matriz["coment"][i].material + ", " + matriz["coment"][i].cor + ", " + matriz["coment"][i].tipo + "</td></tr>";
							list += "</tfoot>";
							list += "</table></div></div>";
							
							console.log(list);
							
							$("#meus_coment").append(list);
						}
					}	
				});
			
			} 
			
			$("a[name = 'btn_pagina']").click(function(){
				valor_botao = $(this).html();
				p = (valor_botao-1)*6;
				$("#meus_coment").html("");
				carrega_coment(p);
			});
		});
	</script>
	
	<form>	
		<div class = "container-fluid">
			<div class = "row"><div class = "col-12 text-rigth p-3"><h3>Comentar</h3></div></div>
			<div class = "form-row align-items-center">
				<div class = "col-auto">
					<div class = "input-group mb-2">
						<textarea placeholder = "Digite o seu comentário aqui..." name = "coment" id = "inlineFormInputGroup" class = "form-control" rows = "3"></textarea>
					</div>	
				</div>	
				
				<div class = "col-auto">
					<input type = "button" value = "Postar" id = "postar" class = "btn btn-dark mb-2" />
				</div>
				<?php
					$id = $_GET["id"];
					
					$CPF = "";
					
					if(isset($_SESSION["autorizado"])){
						$CPF = $_SESSION["autorizado"];
					}
				?>
				
				<?php echo '<input type = "hidden"  value = "'.$CPF.'" id = "CPF" />'; ?>
				<?php echo '<input type = "hidden" value = "'.$id.'" id = "id_roupa" />'; ?>
			
			</div>

			<div id="a"></div>
		</div>			
	</form>

		<div class = "container-fluid">
			<div class = "row"><div class = "col-12 text-rigth p-3"><h3>Outros Comentários</h3></div></div>
			<div id = "meus_coment" class = "row"></div>
		</div>

		<div class = "container-fluid">
			<div id = "paginacao">
				<?php include("paginacao_comentario.php");?>
			</div>
		</div>

	<?php include("rodaspe.html"); ?>
</div>	

</body>

</html>