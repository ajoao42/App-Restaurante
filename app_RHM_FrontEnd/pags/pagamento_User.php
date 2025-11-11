<?php 
			$accao = 'readPagamento'; require 'controller.php'; 
			require_once '../../app_RHM_private/acesso/validar_acesso.php';
			require_once '../../app_RHM_private/config/conexao.php';
			require_once '../../app_RHM_private/models/model_pagamento.php';
			require_once '../../app_RHM_private/services/service_pagamento.php';
			$conn = new ClssConexao();
			$model = new ClssModelPagamento();
			$service = new ClssPagamento($conn, $model); 
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Pagamento</title>
	<!--Bootstrap-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!--Fontawesome-->
	<link rel="stylesheet"  href="../fontawesome/css/all.css">
	<!--Configurações Customizadas-->
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<!--Tags do icone da logo no navegador-->
  <link rel="icon" href="../img/Icone228x.ico">
</head>
<body class="bg-secondary">

<!--Inicio do Cabeçalho do App-->
	<header>
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
			<!--Inicio do Logotipo do sistema-->
			<a href="home_User.php" class="navbar-brand">
				<span class="h3 text-white font-weight-bold">Restaurante <span class="text-warning">Hotel Miradouro</span><i class="fas fa-hotel ml-2"></i></span>	
			</a><!--Fim do Logotipo do sistema-->

			<!--Inicio do Usuário logoado ao sistema-->
			<ul class="navbar-nav ml-auto">

	      <li class="nav-item">
	          <a class="nav-link" href="###">
	          	<span class="h6 font-weight-bold text-warning">Usuário Logado: <i class="text-white"><?= $_SESSION['usuario']; ?></i></span>
	          </a>
	      </li>

	      <li class="nav-item">
            <a class="nav-link" href="###">
              <span class="h6 font-weight-bold text-warning">Data: 
              <i class="text-white"><?php date_default_timezone_set('Africa/Luanda'); echo date('Y/m/d H:i:s'); ?></i></span>
            </a>
        </li>
	      
	    </ul><!--Fim do Usuário logoado ao sistema-->
		</nav>
	</header><!--Fim do Cabeçalho do App-->

<!--Inicio do Corpo do App-->
	<section>	
		<div class="row mx-0 my-2"><!--Inicio da Row-->

			<!--Inicio da área lateral dos menus-->
			<div class="col-sm-2 mb-5 mt-5">

				<!--Inicio do botão Home-->
				<div class="mt-2 mb-2">
					<a href="home_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-home mr-2"></i>Home</a>
				</div><!--Fim do botão Home-->

				<!--Inicio do botão Cliente-->
				<div class="mt-2 mb-2">
					<a href="cliente_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-user mr-2"></i>Cliente</a>
				</div><!--Fim do botão Cliente-->

				<!--Inicio do botão Reserva-->
				<div class="mt-2 mb-2">
					<a href="reserva_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-list-alt mr-2"></i>Reserva</a>
				</div><!--Fim do botão Reserva-->

				<!--Inicio do botão Mesa-->
				<div class="mt-2 mb-2">
					<a href="mesa_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-table mr-2"></i>Mesa</a>
				</div><!--Fim do botão Mesa-->

				<!--Inicio do botão Pedido-->
				<div class="mt-2 mb-2">
					<a href="pedido_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-edit mr-2"></i>Pedido</a>
				</div><!--Fim do botão Pedido-->

				<!--Inicio do botão Pagamento-->
				<div class="mt-2 mb-2">
					<a href="pagamento_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-credit-card mr-2"></i>Pagamento</a>
				</div><!--Fim do botão Pagamento-->

				<!--Inicio do botão Definição-->
				<div class="mt-2 mb-2">
					<a href="logoff.php" class="btn btn-dark btn-block ml-2">Terminar sessão</a>
				</div><!--Fim do botão Definição-->
			</div><!--Fim da área lateral dos menus-->

			<!--Inicio da área central dos cadastros-->
				<div class="col-sm-3 mb-5 mt-3 border rounded bg-dark border-warning">

					<h3 class="text-center text-white mb-2 mt-2 border-bottom border-warning">Fazer Pagamento</h3>

					<!--Condição em php para pesquisar o registro na BD para a edição-->
					<?php if (isset($_GET['idup'])) {
								$idupdate = $_GET['idup'];
								$pag = $service->pesquisarPagamento($idupdate); }	?>

				<div class=" form-group text-white"><!--Inicio da Div do formulario-->

					<form action="<?php if(isset($pag)) { ?> controller.php?accao=updatePagamento <?php } else{ ?>controller.php?accao=creatPagamento<?php } ?>" method="POST">

						<label for="cliente" class="text-white font-weight-bold">Cliente</label>
						<select name="cliente" class="form-control mb-2 border border-warning" id="cliente">
							<option value="Null">Selecione o cliente</option>
							<?php //Codigo para buscar a informar na base de dados e exibir na cBox
							
								$cliente = $service->pesquisarCliente();

								foreach ($cliente as $rows) 
								{ 
									echo "<option value=".$rows->idpedido.">".$rows->nome."</option>";
								} 
							?>
						</select>

						<label for="pedido" class="text-white font-weight-bold">Pedido</label>
						<select name="pedido" class="form-control mb-2 border border-warning" id="pedido">
							<option value="Null">Selecione o Pedido</option>
							<?php //Codigo para buscar a informar na base de dados e exibir na cBox
							
								$cliente = $service->pesquisarCliente();

								foreach ($cliente as $rows) 
								{ 
									echo "<option value=".$rows->idpedido.">".$rows->nome_menu."</option>";
								} 
							?>
						</select>

						<label for="qtd" class="text-white font-weight-bold">Quantidade</label>
						<select name="qtd" class="form-control mb-2 border border-warning" id="qtd">
							<option value="Null">Selecione a Quantidade</option>
							<?php //Codigo para buscar a informar na base de dados e exibir na cBox
							
								$cliente = $service->pesquisarCliente();

								foreach ($cliente as $rows) 
								{ 
									echo "<option value=".$rows->idpedido.">".$rows->qtd."</option>";
								} 
							?>
						</select>
						
						<label for="valor" class="text-white font-weight-bold">Valor a Pagar</label>
						<select name="valor" class="form-control mb-2 border border-warning" id="valor">
							<option value="Null">Selecione a Preço</option>
							<?php //Codigo para buscar a informar na base de dados e exibir na cBox
							
								$cliente = $service->pesquisarCliente();

								foreach ($cliente as $rows) 
								{ 
									echo "<option value=".$rows->total.">".$rows->total."</option>";
								} 
							?>
						</select>
						
						<label for="valor_devido" class="text-white font-weight-bold">Valor Pago</label>
						<input type="text" name="valor_devido" class="form-control mb-2 border border-warning" id="valor_devido" placeholder="Ex: 100.000,00" value="<?php if(isset($pag)){echo $pag['valor'];} ?>">

						<label for="status" class="text-white font-weight-bold">Status</label>
						<select name="status" class="form-control mb-4 border border-warning" id="status" >
							<option value="Null">Status do Pagamento</option>
							<option value="<?php if(isset($pag)){echo $pag['status'];}else{ echo('Pago');} ?>">Pago
							</option>
							<option value="<?php if(isset($pag)){echo $pag['status'];}else{ echo('Não Pago');} ?>">Não Pago</option>
						</select>

						<input type="hidden" name="idpag" value="<?php if(isset($pag)){echo $pag['idpagamento'];} ?>">
						<input type="hidden" name="idfa" value="<?php if(isset($pag)){echo $pag['idfactura'];} ?>">

						<!--Validação em php para notificar registro cadastrado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'save') { ?>

	          <div class="text-white text-justify text-center mt-0 mb-0 bg-success">
	            <i class="fas fa-check fa-white mr-3"></i>Registro inserido com sucesso!
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar erro de campos vazios-->
	        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'erro1') { ?>

	          	<div class="text-white text-justify text-center mt-0 mb-0 bg-warning">
	           	 Preenche todos campos para o cadastramento 
	          	</div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro cancelado com succeso-->
	        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'delete') { ?>

	          	<div class="text-white text-justify text-center mt-0 mb-0 bg-danger">
	           	 Registro cancelado com sucesso
	          	</div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro cancelado com succeso-->
	        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'update') { ?>

	          	<div class="text-white text-justify text-center mt-0 mb-0 bg-info">
	           	 Registro Actualizado com sucesso
	          	</div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro cancelado com succeso-->
	        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'factura') { ?>

	          	<div class="text-white text-justify text-center mt-0 mb-0 bg-danger">
	           	 <i class="fas fa-window-close"></i>Ocorreu um erro a gerar a factura
	          	</div>

	        	<?php } ?>

						<input type="submit" class="btn btn-warning btn-block mt-2 mb-2 font-weight-bold" value="<?php if(isset($pag)) {echo('Actualizar');}else{echo('Pagar');} ?>">
						<p class="text-center">Ou</p>

						<ul class="list-inline text-center">
							<li class="list-inline-item">
								<a href="###" class="barra"><img src="../img/cc-visa.svg" width="30" height="30"></a>
							</li>
							<li class="list-inline-item">
								<a href="###" class="barra"><img src="../img/Bailogo.png" width="29" height="29"></a>
							</li>
							<li class="list-inline-item">
								<a href="###" class="barra"><img src="../img/cc-paypal.svg" width="30" height="30"></a>
							</li>
						</ul>

					</form>
					</div><!--Fim da Div do formulario-->
				</div><!--Fim da área central dos cadastros-->

			<!--Inicio da área lateral das consultas-->
				<div class="col-sm-7 mb-5 mt-3 border rounded bg-dark border-warning">

					<div class="table-responsive"><!--Inicio da Div tablea Responsive-->

						<table class="table table-sm text-white"><!--Inicio da tablea-->
							<thead class="table-dark">
								<tr>
									<th>Cliente</th>
									<th>Pedido</th>
									<th>Qtd.</th>
									<th>Valor</th>
									<th>Valor Pago</th>
									<th>Status</th>
									<th colspan="3"></th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($readPagamento as $pag) { ?>
								<tr>
									<td id="pag_<?= $pag->idpagamento ?>"><?= $pag->nome ?></td>
									<td id="pag_<?= $pag->idpagamento ?>"><?= $pag->nome_menu ?></td>
									<td id="pag_<?= $pag->idpagamento ?>"><?= $pag->qtd ?></td>
									<td id="pag_<?= $pag->idpagamento ?>"><?= $pag->total ?></td>
									<td id="pag_<?= $pag->idpagamento ?>"><?= $pag->valor_devido ?></td>
									<td id="pag_<?= $pag->idpagamento ?>"><?= $pag->status ?></td>
									<td>
										<a href="pagamento_User.php?idup=<?= $pag->idpagamento ?>"><i class="fas fa-edit text-info"></i>
										</a>
									</td>
									<td>
										<a href="factura_User.php?idfa=<?= $pag->idfactura ?>"><i class="fas fa-print text-light"></i></a>
									</td>
									<td>
										<a href="controller.php?accao=deletePagamento&id=<?= $pag->idpagamento ?>"><i class="fas fa-window-close text-danger"></i>
										</a>
									</td>
								</tr>	
								<?php } ?>				
							</tbody>
						</table><!--Fim da tablea-->

					</div><!--Fim da Div tablea Responsive-->
				</div><!--Fim da área lateral das consultas-->

		</div><!--Fim da Row-->
	</section><!--Fim do Corpo do App-->

<!--Inicio do Rodapé do App-->
	<footer>
		<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3 mt-4">
			<div class="row">
				<div class="col-sm-9">
					<p class="text-white font-weight-bold mb-0">Restaurante<span class="text-warning"> Hotel Miradouro</span>: seu app de sabores inigualáveis</p>
					<span class="">Todos direitos reservado by: Grande Grupo</span> &copy; Copyright 2023
				</div>

				<div class="col-sm-3">
					<span class="text-white font-weight-bold">Contactos:</span><br>

					<a href="###" style="text-decoration: none;">
						<img src="../img/facebook.svg" class="img-fluid ml-2" width="25" height="25">
					</a>

					<a href="###" style="text-decoration: none;">
						<img src="../img/github.svg" class="img-fluid ml-2" width="25" height="25">
					</a>

					<a href="###" style="text-decoration: none;">
						<img src="../img/google.svg" class="img-fluid ml-2" width="25" height="25">
					</a>

					<a href="###" style="text-decoration: none;">
						<img src="../img/whatsapp.svg" class="img-fluid ml-2" width="25" height="25">
					</a>
				</div>
			</div>
		</div>
	</footer><!--Fim do Rodapé do App-->

<!--Configurações JS-->
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>
