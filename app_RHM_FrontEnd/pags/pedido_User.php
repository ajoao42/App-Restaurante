<?php 
			$accao = 'readPedido'; 
			require 'controller.php'; 
			require_once '../../app_RHM_private/acesso/validar_acesso.php';
			require_once '../../app_RHM_private/config/conexao.php'; 
			require_once '../../app_RHM_private/models/model_pedido.php';
			require_once '../../app_RHM_private/services/service_pedido.php';
			$conn = new ClssConexao(); 
			$model = new ClssModelPedido();
			$service = new ClssPedido($conn, $model);
			
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Pedido</title>
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
						<a href="pedido_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-edit mr-2"></i>Pedido</a>
					</div><!--Fim do botão Pedido-->

					<!--Inicio do botão Pagamento-->
					<div class="mt-2 mb-2">
						<a href="pagamento_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-credit-card mr-2"></i>Pagamento</a>
					</div><!--Fim do botão Pagamento-->

					<!--Inicio do botão Definição-->
					<div class="mt-2 mb-2">
						<a href="logoff.php" class="btn btn-dark btn-block ml-2">Terminar sessão</a>
					</div><!--Fim do botão Definição-->
				</div><!--Fim da área lateral dos menus-->

				<!--Inicio da área central dos cadastros-->
				<div class="col-sm-3 mb-5 mt-3 border rounded bg-dark border-warning">

					<h3 class="text-center text-white mb-2 mt-2 border-bottom border-warning">Fazer Pedido</h3>

					<!--Código em PHP para pesquisar registro para a actualização-->
					<?php if (isset($_GET['idup'])) {
								$idupdate = $_GET['idup'];
								$ped = $service->pesquisarPedido($idupdate); }	?>

					<div class=" form-group text-white"><!--Inicio da Div Formulario-->

						<form action="<?php if(isset($ped)) { ?> controller.php?accao=updatePedido <?php } else{ ?>controller.php?accao=creatPedido<?php } ?>" method="POST">

							<label for="cliente" class="text-white font-weight-bold">Cliente</label>
							<select name="cliente" class="form-control mb-2 border border-warning" id="cliente" >
								<option selected>Selecione o cliente</option>
								<?php //Codigo para buscar a informar na base de dados e exibir na cBox

									$Pcliente = $service->pesquisarCliente();

									foreach ($Pcliente as $cli) 
									{ 
										echo "<option value=".$cli->idreserva.">".$cli->nome."</option>";
									} 

								?>
							</select>

							<label for="mesa" class="text-white font-weight-bold">Mesa</label>
							<select name="mesa" class="form-control mb-2 border border-warning" id="mesa" >
								<option selected>Selecione a mesa</option>
								<?php //Codigo para buscar a informar na base de dados e exibir na cBox
									
									$Pmesa = $service->pesquisarMesa();

									foreach ($Pmesa as $mesa)
									{
										echo "<option value=".$mesa->idmesa.">".$mesa->mesa."</option>";
									}

								?>
							</select>

							<label for="menu" class="text-white font-weight-bold">Produto</label>
							<select name="menu" class="form-control mb-2 border border-warning" id="menu" >
								<option selected>Selecione o prato</option>
								<?php //Codigo para buscar a informar na base de dados e exibir na cBox

									$Pmenu = $service->pesquisarMenu();

									foreach ($Pmenu as $menu) 
									{ 
										echo "<option value=".$menu->iditem.">".$menu->nome_menu."</option>";
									} 
								?>
							</select>

							<label for="qtd" class="text-white font-weight-bold">Quantidade</label>
							<input type="number" name="qtd" min="0" class="form-control mb-2 border border-warning" id="qtd" value="<?php if(isset($ped)){echo $ped['qtd'];}else{ echo(1); } ?>">

							<label for="status" class="text-white font-weight-bold">Status do Pedido</label>
							<select name="status" class="form-control mb-2 border border-warning" id="status">
								<option value="Null">Status do Pedido</option>
								<option value="Preparando">Preparando</option>
								<option value="Pronto">Pronto</option>
							</select>
							
							<label for="total" class="text-white font-weight-bold">Total</label>
							<input type="text" name="total" class="form-control mb-4 border border-warning" id="total" placeholder="Ex: 100.000,00" value="<?php if(isset($ped)){echo $ped['total'];} ?>">

							<input type="hidden" name="id" value="<?php if(isset($ped)){echo $ped['idpedido'];} ?>">

							<!--Validação em php para notificar registro cadastrado com sucesso-->
							<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'save') { ?>

		          <div class="text-white text-justify text-center mt-0 mb-0 bg-success">
		            <i class="fas fa-check fa-white mr-3"></i>Registro inserido com sucesso!
		          </div>

		        	<?php } ?>

		        	<!--Validação em php para notificar registro actualizado com sucesso-->
		        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'update') { ?>

		          	<div class="text-white text-justify text-center mt-0 mb-0 bg-info">
		           	 Registro actualizado com sucesso
		          	</div>

		        	<?php } ?>

		        	<!--Validação em php para notificar registro cancelado com sucesso-->
		        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'delete') { ?>

		          	<div class="text-white text-justify text-center mt-0 mb-0 bg-danger">
		           	 Registro cancelado com sucesso
		          	</div>

		        	<?php } ?>

		        	<!--Validação em php para notificar erro de campos vazios-->
		        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'erro1') { ?>

		          	<div class="text-white text-justify text-center mt-0 mb-0 bg-warning">
		           	 Preenche todos campos para o cadastramento 
		          	</div>

		        	<?php } ?>

							<input type="submit" class="btn btn-warning btn-block mt-4 mb-5 font-weight-bold" value="<?php if(isset($ped)){echo 'Actualizar';}else{echo 'Pedir';} ?>">

						</form>

					</div><!--Fim da Div Formulario-->
				</div><!--Fim da área central dos cadastros-->

				<!--Inicio da área lateral das consultas-->
				<div class="col-sm-7 mb-5 mt-3 border rounded bg-dark border-warning">

					<div class="table-responsive"><!--Inicio da Div table Responsive-->
							<table class="table table-sm text-white"><!--Tabela-->
								<!--Inicio do Cabeçalho da Tabela-->
								<thead class="table-dark">
									<tr>
										<th>Cliente</th>
										<th>Mesa</th>
										<th>Produto</th>
										<th>Qtd.</th>
										<th>Status</th>
										<th>Total</th>
										<th colspan="2"></th>
									</tr>
								</thead><!--Fim do Cabeçalho da Tabela-->

								<!--Inicio do Corpo da Tabela-->
								<tbody>
									<?php foreach ($readPedido as $pedido) { ?>
										<tr>
											<td id="pedido_<?= $pedido->idpedido ?>">
												<?= $pedido->nome ?>
											</td>
											<td id="pedido_<?= $pedido->idpedido ?>">
												<?= $pedido->mesa ?>
											</td>
											<td id="pedido_<?= $pedido->idpedido ?>">
												<?= $pedido->nome_menu ?>
											</td>
											<td id="pedido_<?= $pedido->idpedido ?>">
												<?= $pedido->qtd ?>
											</td>									
											<td id="pedido_<?= $pedido->idpedido ?>">
												<?= $pedido->status ?>
											</td>
											<td id="pedido_<?= $pedido->idpedido ?>">
												<?= $pedido->total ?>
											</td>

											<td>
												<a href="pedido_User.php?idup=<?= $pedido->idpedido ?>"><i class="fas fa-edit text-info"></i>
												</a>
											</td>

											<td>
												<a href="controller.php?accao=deletePedido&id=<?= $pedido->idpedido ?>"><i class="fas fa-window-close text-danger"></i>
												</a>										
											</td>
										</tr>
									<?php } ?>
								</tbody><!--Fim do Corpo da Tabela-->
							</table><!--Fim da Tabela-->

						</div><!--Fim da Div Table Responsive-->
				</div><!--Fim da área lateral das consultas-->

			</div><!--Fim da Row-->
			</div><!--Fim da Container-->
		</section><!--Fim do Corpo do App-->

	<!--Inicio do Rodapé do App-->
		<footer>
			<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3" style="margin-top: 71px;">
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
		</footer><!--Fim do Roudapé do App-->

	<!--Configurações JS-->
		<script src="../js/jquery-3.3.1.slim.min.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>

</body>
</html>
