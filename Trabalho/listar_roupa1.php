		<script>var decisao = "NO"</script>

<?php
	include("menu.php");
	
	if(isset($_SESSION["autorizado"])){
		if(!($_SESSION["CliOuLoja"] == "Loja")){
?>
			<script>decisao = 'Yes'</script>
<?php
		}
	}
?>

			<script>
				var filtro = null
				$(document).ready(function(){
					paginacao(0);
					
					function paginacao(p){
						$.ajax({
							url: "listar_roupa2.php",
							type: "post",
							data: {pg: p, nome_filtro: filtro},
							success: function(m){
								$("#tb").html("");
								for(i=0;i<m.length;i++){
									linhas = "<table class = 'table table-bordered w-50 text-center m-auto'>";
									linhas += "<tbody>";
									linhas += "<tr>";
									linhas += "<td scope = 'row'>Marca: " + m[i].marca + "</td>";
									linhas += "<td rowspan = '9'><img src = 'fotos/" + m[i].foto + "' name = 'foto' class = 'rounded w-100'/></td>";
									linhas += "</tr>";
									linhas += "<tr><td>Tamanho: " + m[i].tamanho + "</td></tr>";
									linhas += "<tr><td>Lançamento: " + m[i].ano_lancamento + "</td></tr>";
									linhas += "<tr><td>Quantidade: " + m[i].quantidade + "</td></tr>";
									linhas += "<tr><td>Material: " + m[i].material + "</td></tr>";
									linhas += "<tr><td>Cor: " + m[i].cor + "</td></tr>";
									linhas += "<tr><td>Tipo: " + m[i].tipo + "</td></tr>";
									linhas += "<tr><td>Preço: " + m[i].preco + "</td></tr>";
									linhas += "<tr><td>Gênero: " + m[i].genero + "</td></tr>";
									linhas += "<tr><td colspan = '2'>";
									if(decisao == "Yes"){
										linhas += "<a href = 'comprar.php?id=" + m[i].id_roupa + "' class = 'badge badge-secondary p-2'>Comprar</a>    ";
									}
									linhas += "<a href = 'form_comentario.php?id=" + m[i].id_roupa + "' class = 'badge badge-secondary p-2'>Comentar</a></td></tr>";
									linhas += "</tbody>";
									linhas += "</table><br/>";
									
									$("#tb").append(linhas);
								}
							}
						});
					}
					
					$("a[name = 'btn_pagina']").click(function(){
						p = $(this).html();
						p = (p-1)*2;
						paginacao(p);
					});

					// FILTRAR
					
					$("#filtrar").click(function(){
						$.ajax({
							url: "paginacao_roupas.php",
							type: "get",
							data:{nome_filtro: $("input[name='nome_filtro']").val()},
							success: function(d){
								$("#paginacao").html(d);
								filtro = $("input[name='nome_filtro']").val();
								paginacao(0);
							}
						});
					});
				});
			</script>

			<div class = "container-fluid">
				<div class = "row"><div class = "col-12 text-rigth p-3"><h3>Filtro</h3></div></div>
				<div class = "form-row align-items-center">
					<div class = "col-auto">
						<div class = "input-group mb-2">
							<label class="sr-only" for = "inlineFormInputGroup">filtro </label>
							<input type = "text" class="form-control" name = "nome_filtro" id="inlineFormInputGroup" placeholder = "Marca da roupa..." />
						</div>
					</div>
					<div class = "col-auto">
						<input type = "button" value = "Filtrar" id = "filtrar" class = "btn btn-dark mb-2" />
					</div>
				</div>
			</div>
			
			<div class = "container-fluid">
				<div class = "row"><div class = "col-12 text-center p-3"><h3>Roupas</h3></div>
			</div>
			
			<div class = "container-fluid">
				<div class = "row justify-content-center">
					<div class = "col-12" id = "tb" ></div>
				</div>
			</div>

			<div class = "container-fluid">
				<div id = "paginacao">
					<?php include("paginacao_roupas.php"); ?>
				</div>
			</div>

			<?php include("rodaspe.html"); ?>

		</div>
	</body>
</html>