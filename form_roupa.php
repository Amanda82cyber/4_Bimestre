<?php
	include("menu.php");
	include("verificacao.php");
	include("conexao.php");
	
	if($_SESSION["CliOuLoja"] != "Loja"){
		echo '<div class = "row"><div class = "col-12 text-center p-5"><h2>Esta página não pode ser acessada por você!!!</h2></div></div>';
		die();
	}
?>		
		<script src = "cadastrar.js"></script>
		<script>
			var id = null
			var filtro = null
			$(document).ready(function(){
				carrega_roupa(0);

				// EXCLUINDO

				$(document).on("click",'img[name="excluir"]',function(){
					id_roupa = $(this).attr("id_roupa");
					linha = $(this).closest("table");
					$.ajax({
						url:"remover.php",
						type:"post",
						data:{id_roupa: id_roupa},
						
						beforeSend:function(){
							$("#ex").html("<div class = 'text-center'>Excluinto roupa...</div>");
							$("#ex").css("color","brown");
						},
						
						success: function(data){
							if(data==1){
								$("#ex").html("<div class = 'text-center'>Roupa excluída!</div>");
								$("#ex").css("color","green");
								linha.remove();
								carrega_roupa(0);
								
							}else{
								$("#ex").html("<div class = 'text-center'>Esta roupa não pode ser excluída.</div>");
								$("#ex").css("color","red");
							}
						},
						
						error: function(e){
							$("#ex").html("<div class = 'text-center'>Sistema de remoção indisponível.</div>");
							$("#ex").css("color","red");
						}
					});
				});
				
				// PAGINAÇÃO

				function carrega_roupa(pg){
					$.ajax({
						url: "listar_minhas_roupas1.php",
						type: "get",
						data: {pagina: pg, nome_filtro: filtro},
						success: function(matriz_roupas){
							$("#listagem").html("");
							for(i=0;i<matriz_roupas["roupa"].length; i++){
								list = "<table class = 'table table-bordered w-50 text-center m-auto'>";
								list += "<tbody>";
								list += "<tr>";
								list += "<td>CNPJ: " + matriz_roupas["roupa"][i].CNPJ+"</td>";
								list += "<td rowspan = '10' class = 'foto' foto = '" + matriz_roupas["roupa"][i].foto + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'><img src='fotos/" + matriz_roupas["roupa"][i].foto + "' name = 'foto' class='rounded w-100' /></td>";
								list += "</tr>";
								list += "<tr><td class = 'cor' cor_sim = '" + matriz_roupas["roupa"][i].cor + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Cor: " + matriz_roupas["roupa"][i].cor + "</td></tr>";

								list += "<tr><td class = 'tipo' tipo = '" + matriz_roupas["roupa"][i].tipo + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Tipo: " + matriz_roupas["roupa"][i].tipo + "</td></tr>";

								list += "<tr><td class = 'marca' marca = '" + matriz_roupas["roupa"][i].marca + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Marca: " + matriz_roupas["roupa"][i].marca + "</td></tr>";

								list += "<tr><td class = 'tamanho' tamanho = '" + matriz_roupas["roupa"][i].tamanho + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Tamanho: " + matriz_roupas["roupa"][i].tamanho + "</td></tr>";

								list += "<tr><td class = 'material' material = '" + matriz_roupas["roupa"][i].material + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Material: " + matriz_roupas["roupa"][i].material + "</td></tr>";

								list += "<tr><td class = 'quant' qtd = '" + matriz_roupas["roupa"][i].quantidade + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Quantidade: " + matriz_roupas["roupa"][i].quantidade + "</td></tr>";

								list += "<tr><td class = 'preco' pr = '" + matriz_roupas["roupa"][i].preco + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Preço: " + matriz_roupas["roupa"][i].preco + "</td></tr>";

								list += "<tr><td class = 'genero' gen = '" + matriz_roupas["roupa"][i].genero + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Gênero: " + matriz_roupas["roupa"][i].genero + "</td></tr>";

								list += "<tr><td class = 'data' dt = '" + matriz_roupas["roupa"][i].ano_lancamento + "' id_r = '" + matriz_roupas["roupa"][i].id_roupa + "'>Data de Lançamento: " + matriz_roupas["roupa"][i].ano_lancamento + "</td></tr>";

								list += "<tr><td colspan = '2'>";
								list += "<img src='alterar.png' class = 'alterar' id_roupa = " + matriz_roupas["roupa"][i].id_roupa + " />        ";
								list += "<img src='remov.png' name = 'excluir' id_roupa = " + matriz_roupas["roupa"][i].id_roupa + " />";
								list += "</td></tr>";
								list += "</tbody>";
								list += "</table><br/>";
								
								//console.log(list);
								
								$("#listagem").append(list);
							}
						}	
					});
				
				} 
				
				$("a[name = 'btn_pagina']").click(function(){
					valor_botao = $(this).html();
					console.log(valor_botao);
					p = (valor_botao-1)*2;
					$("#listagem").html("");
					carrega_roupa(p);
				});

				// ALTERAÇÃO EM BLOCO
				
				$(document).on("click",".alterar",function(){
					id = $(this).attr("id_roupa");
					botao = $(this);
					$.ajax({
						url: "carrega_roupas_alterar.php",
						type: "post",
						data: {id: id},
						success: function(vetor){
							$("input[name = 'material']").val(vetor.material);
							$("input[name = 'tamanho']").val(vetor.tamanho);
							$("input[name = 'ano_lancamento']").val(vetor.ano_lancamento);
							$("input[name = 'quantidade']").val(vetor.quantidade);
							$("input[name = 'marca']").val(vetor.marca);
							$("input[name = 'cor']").val(vetor.cor);
							$("input[name = 'tipo']").val(vetor.tipo);
							$("input[name = 'preco']").val(vetor.preco);
							// $("input[name = 'arquivo']").val(vetor.foto);
							if(vetor.genero == "F"){
								$("input[name = 'genero'][value='M']").attr("checked", false);
								$("input[name = 'genero'][value='F']").attr("checked", true);
							}else{
								$("input[name = 'genero'][value='F']").attr("checked", false);
								$("input[name = 'genero'][value='M']").attr("checked", true);
							}
							img = "<div class = 'w-75 pl-2 border bg-white rounded'><img src='fotos/"+vetor.foto+"' class='w-25' /></div>";							
							$(".custom-file-label").html(img);
							// $(".custom-file-input").addAttr("value", "" + vetor.foto + "");												
							$(".enviar").attr("class","alteracao");
							$(".alteracao").addClass("btn");
							$(".alteracao").addClass("btn-dark");
							$("#A").html("<br/><br/><br/>"); // Fiz isso para que quando se for usar em um dispositivo móvel o botão não sumir
							// $(".alteracao").addClass("mt-50");
							$(".alteracao").val("Alterar Cadastro...");
						}
					});
				});

				$(".custom-file-input").change(function(){
					if($(".custom-file-label").html() != "Escolher foto"){
						if($(".custom-file-input").val() != ""){
							$(".custom-file-label").html("Foto escolhida!");
						}
					}
				});
				
				$(document).on("click",".alteracao",function(){
					
					var form = $("#f")[0]; //recebe o formulário inteiro
					var formData = new FormData(form);
					formData.append("id", id);
					$.ajax({
						url: "insere_roupa.php",
						type: "post",
						enctype: "multipart/form-data",
						data: formData,
						processData: false,
						contentType: false, //processa o cabeçalho???
						success: function(data){
							console.log(data);
							if(data==1){
								$("#c").html("Cadastro alterado com sucesso!");
								$("#c").css("color", "green");
								
								$("input[name = 'material']").val("");
								$("input[name = 'tamanho']").val("");
								$("input[name = 'ano_lancamento']").val("");
								$("input[name = 'quantidade']").val("");
								$("input[name = 'marca']").val("");
								$("input[name = 'cor']").val("");
								$("input[name = 'tipo']").val("");
								$("input[name = 'preco']").val("");
								$("input[name = 'genero']").prop("checked", false);
								$(".alteracao").attr("class","enviar");
								$(".enviar").addClass("btn");
								$(".enviar").addClass("btn-dark");
								$(".custom-file-label").html("Escolher foto");
								$("#A").html("");
								$(".enviar").val("Enviar");
								carrega_roupa(0);
							}else{
								$("#c").html("Não foi possível alterar o cadastro desta roupa!");
								$("#c").css("color", "red");
							}
						}
					});
				});
				
				
				// ALTERAÇÃO POR CAMPO

				// Foto

				$(document).on("click",".foto",function(){
					td = $(this);
					foto = $(this).attr("foto");
					localStorage.setItem('fotinha', "" + foto + "");
					id_r = $(this).attr("id_r");
					td.html("<form id='f_alterar'><input type = 'file' name='foto_alterar' id = 'foto_alterar' id_r = '" + id_r + "' value = '" + foto + "' td = '" + td + "'/></form>");
					
					td.attr("class", "foto_alterar");
					$("#foto_alterar").click();
				});
				
				$(document).on("change",".foto_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					ft = $("#foto_alterar").val();
					var form = $("#f_alterar")[0]; //recebe o formulário inteiro
					
					var formData = new FormData(form);
					formData.append("id", id_linha);
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						enctype: "multipart/form-data",
						data: formData,
						processData: false,
						contentType: false,
						success: function(data){
							console.log(data);
							if(data!="0" && data!="1"){
								//alert("AA");
								foto = "<img src='fotos/" + data + "' name = 'foto' class = 'rounded w-100' />";
								td.html(foto);
								td.attr("class", "foto");
							}
							
						},
					});
				});

				$(document).on("mouseout",".foto_alterar",function(){
					td = $(this);
					ft = localStorage.getItem('fotinha');
					foto = "<img src='fotos/" + ft + "' name = 'foto' class = 'rounded w-100' />";
					td.html(foto);
					td.attr("class", "foto");
					localStorage.removeItem('fotinha');  
				});

				// Cor

				$(document).on("click",".cor",function(){
					td = $(this);
					cor = $(this).attr("cor_sim");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'color' id = 'cor_alterar' id_r = '" + id_r + "' value = '" + cor + "' />");
					td.attr("class", "cor_alterar");
				});

				$(document).on("change",".cor_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					//console.log($("#cor_alterar").val());
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'cor', valor: $("#cor_alterar").val(), id: id_linha},
						success: function(){
							cor = "Cor: " + $("#cor_alterar").val() + " ";
							td.html(cor);
							td.attr("class", "cor");
						},
					});
				});
				
				// Tipo
				
				$(document).on("click",".tipo",function(){
					td = $(this);
					tipo = $(this).attr("tipo");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'text' id = 'tipo_alterar' id_r = '" + id_r + "' value = '" + tipo + "' />");
					td.attr("class", "tipo_alterar");
				});

				$(document).on("blur",".tipo_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'tipo', valor: $("#tipo_alterar").val(), id: id_linha},
						success: function(){
							tipo = "Tipo: " + $("#tipo_alterar").val() + " ";
							td.html(tipo);
							td.attr("class", "tipo");
						},
					});
				});

				// Marca
				
				$(document).on("click",".marca",function(){
					td = $(this);
					marca = $(this).attr("marca");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'text' id = 'marca_alterar' id_r = '" + id_r + "' value = '" + marca + "' />");
					td.attr("class", "marca_alterar");
				});

				$(document).on("blur",".marca_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'marca', valor: $("#marca_alterar").val(), id: id_linha},
						success: function(){
							marca = "Marca: " + $("#marca_alterar").val() + " ";
							td.html(marca);
							td.attr("class", "marca");
						},
					});
				});

				// Tamanho
				
				$(document).on("click",".tamanho",function(){
					td = $(this);
					tamanho = $(this).attr("tamanho");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'text' id = 'tamanho_alterar' id_r = '" + id_r + "' value = '" + tamanho + "' />");
					td.attr("class", "tamanho_alterar");
				});

				$(document).on("blur",".tamanho_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'tamanho', valor: $("#tamanho_alterar").val(), id: id_linha},
						success: function(){
							tamanho = "Tamanho: " + $("#tamanho_alterar").val() + " ";
							td.html(tamanho);
							td.attr("class", "tamanho");
						},
					});
				});

				// Material
				
				$(document).on("click",".material",function(){
					td = $(this);
					material = $(this).attr("material");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'text' id = 'material_alterar' id_r = '" + id_r + "' value = '" + material + "' />");
					td.attr("class", "material_alterar");
				});

				$(document).on("blur",".material_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'material', valor: $("#material_alterar").val(), id: id_linha},
						success: function(){
							material = "Material: " + $("#material_alterar").val() + " ";
							td.html(material);
							td.attr("class", "material");
						},
					});
				});

				// Preço
				
				$(document).on("click",".preco",function(){
					td = $(this);
					preco = $(this).attr("pr");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'number' id = 'preco_alterar' id_r = '" + id_r + "' value = '" + preco + "' />");
					td.attr("class", "preco_alterar");
				});

				$(document).on("blur",".preco_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'preco', valor: $("#preco_alterar").val(), id: id_linha},
						success: function(){
							preco = "Preço: " + $("#preco_alterar").val() + " ";
							td.html(preco);
							td.attr("class", "preco");
						},
					});
				});

				// Gênero
				
				$(document).on("click",".genero",function(){
					td = $(this);
					genero = $(this).attr("gen");
					id_r = $(this).attr("id_r");
					gen_input = "<input type = 'radio' class = 'alterar_gen' id_r = '" + id_r + "' name = 'sexo' value = 'M' />M        ";
					gen_input += "<input type = 'radio' class = 'alterar_gen' id_r = '" + id_r + "' name = 'sexo' value = 'F' />F";
					td.html(gen_input);
					
					if(genero == "M"){
						$(".alterar_gen[value = 'M']").prop("checked", true);
						$(".alterar_gen[value = 'F']").prop("checked", false);
					}else{
						$(".alterar_gen[value = 'F']").prop("checked", true);
						$(".alterar_gen[value = 'M']").prop("checked", false);
					}
					
					td.attr("class", "genero_alterar");
				});

				$(document).on("change",".genero_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'genero', valor: $(".alterar_gen:checked").val(), id: id_linha},
						success: function(){
							genero = "Gênero: " + $(".alterar_gen:checked").val() +  "";
							td.html(genero);
							td.attr("class", "genero");
						},
					});
				});

				// Data de Lançamento
				
				$(document).on("click",".data",function(){
					td = $(this);
					data = $(this).attr("dt");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'date' id = 'data_alterar' id_r = '" + id_r + "' value = '" + data + "' />");
					td.attr("class", "data_alterar");
				});

				$(document).on("blur",".data_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'ano_lancamento', valor: $("#data_alterar").val(), id: id_linha},
						success: function(){
							data = "Data de Lançamento: " + $("#data_alterar").val() + " ";
							td.html(data);
							td.attr("class", "data");
						},
					});
				});

				// Quantidade
				
				$(document).on("click",".quant",function(){
					td = $(this);
					qtd = $(this).attr("qtd");
					id_r = $(this).attr("id_r");
					td.html("<input type = 'number' id = 'qtd_alterar' id_r = '" + id_r + "' value = '" + qtd + "' />");
					td.attr("class", "qtd_alterar");
				});

				$(document).on("blur",".qtd_alterar",function(){
					td = $(this);
					id_linha = $(this).attr("id_r");
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {coluna: 'quantidade', valor: $("#qtd_alterar").val(), id: id_linha},
						success: function(){
							qtd = "Quantidade: " + $("#qtd_alterar").val() + " ";
							td.html(qtd);
							td.attr("class", "quant");
						},
					});
				});

				// FILTRAR
				
				$("#filtrar").click(function(){
					$.ajax({
						url: "paginacao_roupa.php",
						type: "get",
						data:{nome_filtro: $("input[name='nome_filtro']").val()},
						success: function(d){
							$("#paginacao").html(d);
							filtro = $("input[name='nome_filtro']").val();
							carrega_roupa(0);
						}
					});
				});

			});

		</script>

		<div class = "container-fluid">
			<div class = "row"><div class = "col-12 text-center p-3"><h3>Inserir roupa</h3></div></div>
			<form id = "f">
				<div class = "form-row"> 
					<!-- <form id="f" enctype = "multipart/form-data"> -->
					<div class = "form-group col-md-4">
						<!--<div class = "col-12"><h3>Inserir Roupa</h3></div>-->
						<label for="material"> Material: </label>
						<input type = "text" name = "material" class = "form-control" required="required" />
					</div>
						
					<div class = "form-group col-md-4">	
						<label for="tamanho"> Tamanho: </label>
						<input type="text" name = "tamanho" class = "form-control" required="required" />
					</div>
						
					<div class = "form-group col-md-4">
						<label for="ano_lancamento"> Data de Lançamento: </label>
						<input type="date" name = "ano_lancamento" class = "form-control" required="required" />
					</div>
					
					<div class = "form-group col-md-4">	
						<label for="quantidade"> Quantidade: </label>
						<input type="number" name = "quantidade" class = "form-control" required="required" />
					</div>
						
					<div class = "form-group col-md-4">
						<label for="marca"> Marca: </label>
						<input type="text" name = "marca" class = "form-control" required="required" />
					</div>
						
					<div class = "form-group col-md-4">
						<label for="cor"> Cor: </label>
						<input type="color" name = "cor" class = "form-control" required="required" />
					</div>
						
					<div class = "form-group col-md-6">
						<label for="tipo"> Tipo: </label>
						<input type="text" name = "tipo" required="required" class = "form-control" placeholder="EX: saia, blusa..." />
					</div>
						
					<div class = "form-group col-md-6">	
						<label for="preco"> Preço: </label>
						<input type="number" name = "preco" required="required" class = "form-control" step = "0.01" placeholder = "R$" />
					</div>
						
					<div class = "form-group col-md-3">	
						<div class = "form-check form-check-inline">
							<input type="radio" class = "form-check-input" name = "genero" value="F" />
							<label class = "form-check-label" for = "F"> Gênero feminino </label>
						</div>
					</div>
					
					<div class = "form-group col-md-3">	
						<div class = "form-check form-check-inline">
							<input type="radio" class = "form-check-input" name = "genero" value="M" />
							<label class = "form-check-label" for = "M"> Gênero Masculino </label>
						</div>
					</div>
					
					<div class = "form-group col-md-6">	
						<div class="custom-file">
							<label class="custom-file-label" for="foto">Escolher foto </label>
							<input type="file" class = "custom-file-input" name = "arquivo" />
						</div>
					</div>

					<div class = "form-group col-md-12">
						<div id = "A">
							
						</div>
					</div>
						
					<div class = "form-group col-md-12">
						<input type = "button" value = "Inserir" class = "enviar btn btn-dark" />
					</div>
					
					<div id = "c"></div>
						
					<!-- </form> -->
				</div>
			</form>
			
		</div>

		<form>
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
		</form>
		
		<div class = "container-fluid">
			<div class = "row"><div class = "col-12 text-center p-3"><h3>Roupas Cadastradas</h3></div>
		</div>
		
		<div class = "container-fluid">
			<div class = "row justify-content-center">
				<div class = "col-12" id = "listagem" ></div>
			</div>
		</div>
			
		<div id = "ex"></div>
		<div id = "paginacao">
			<?php include("paginacao_roupa.php");?>
		</div>
		
		<?php include("rodaspe.html"); ?>
			
	</div>
	
</body>

</html>