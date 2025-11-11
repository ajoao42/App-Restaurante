<?php 
			$accao = 'readCliente'; require 'controller.php'; 
			require_once '../../app_RHM_private/acesso/validar_acesso.php'; 
			require_once '../../app_RHM_private/config/conexao.php';
			require_once '../../app_RHM_private/models/model_cliente.php';
			require_once '../../app_RHM_private/services/service_cliente.php';
			$conn = new ClssConexao();
			$model = new ClssModelCliente();
			$service = new ClssCliente($conn, $model);
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
	<title>Restaurante H. Miradouro - Cliente</title>
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
						<a href="cliente_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-user mr-2"></i>Cliente</a>
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
						<a href="pagamento_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-credit-card mr-2"></i>Pagamento</a>
					</div><!--Fim do botão Pagamento-->

					<!--Inicio do botão Definição-->
					<div class="mt-2 mb-2">
						<a href="logoff.php" class="btn btn-dark btn-block ml-2">Terminar sessão</a>
					</div><!--Fim do botão Definição-->
				</div><!--Fim da área lateral dos menus-->

				<!--Inicio da área central dos cadastros-->
				<div class="col-sm-3 mb-5 mt-3 border rounded bg-dark border-warning">

					<h3 class="text-center text-white mb-2 mt-2 border-bottom border-warning">Cadastar Cliente</h3>

					<!--Condição em php para pesquisar o registro na BD para a edição-->
					<?php if (isset($_GET['idup'])) {
								$idupdate = $_GET['idup'];
								$cli = $service->pesquisarCliente($idupdate); }	?>

					<div class="form-group text-white"><!--Inicio da Div do Formulario-->

						<form action="<?php if(isset($cli)) { ?> controller.php?accao=updateCliente <?php } else{ ?>controller.php?accao=creatCliente<?php } ?>" method="POST">

							<label for="nome" class="text-white font-weight-bold mt-3">Nome</label>
							<input type="text" name="nome" class="form-control mb-2 border border-warning" placeholder="Digite o primeiro e o ultimo nome" id="nome" value="<?php if(isset($cli)){echo $cli['nome'];} ?>">

							<label for="tlf" class="text-white font-weight-bold">Telefone</label>
							<input type="text" name="tlf" class="form-control mb-2 border border-warning" placeholder="Digite o telefone" id="tlf" value="<?php if(isset($cli)){echo $cli['contacto'];} ?>">

							<label for="restricoes" class="text-white font-weight-bold">Restrições Alimentares</label>
							<input type="text" name="restricoes" class="form-control mb-2 border border-warning" placeholder="Ex: Não como oléo de palma..." value="<?php if(isset($cli)){echo $cli['restric_alimen'];} ?>" id="restricoes">

							<label for="preferencia" class="text-white font-weight-bold">Preferencias Alimentares</label>
							<input type="text" name="preferencia" class="form-control mb-4 border border-warning" placeholder="Ex: A massa tem que ser al-dente..." id="preferencia" value="<?php if(isset($cli)){echo $cli['preferencias'];} ?>">

							<input type="hidden" name="id" value="<?php if(isset($cli)){echo $cli['idcliente'];} ?>">

							<!--Validação em php para notificar registros cadastrados com sucesso-->
							<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'save') { ?>

		          <div class="text-white text-justify text-center mb-0 mt-0 bg-success">
		            <i class="fas fa-check fa-white mr-3"></i>Registro inserido com sucesso!
		          </div>

		        	<?php } ?>

		        	<!--Validação em php para notificar registros actualizado com sucesso-->
							<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'update') { ?>

		          <div class="text-white text-justify text-center mb-0 mt-0 bg-info">
		            Registro actualizado com sucesso!
		          </div>

		        	<?php } ?>

		        	<!--Validação em php para notificar registros deletado com sucesso-->
							<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'delete') { ?>

		          <div class="text-white text-justify text-center mb-0 mt-0 bg-danger">
		            </i>Registro deletado com sucesso
		          </div>

		        	<?php } ?>

		        	<!--Validação em php para notificar erro de campos vazios-->
		        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'erro1') { ?>

		          	<div class="text-white text-justify text-center mb-0 mt-0 bg-warning">
		           	 Preenche todos campos para o cadastramento 
		          	</div>

		        	<?php } ?>

							<input type="submit" class="btn btn-warning btn-block mt-2 mb-5 font-weight-bold" value="<?php if(isset($cli)) {echo('Actualizar');}else{echo('Cadastrar');} ?>">

						</form>
					</div><!--Fim da Div do Formulario-->
				</div><!--Fim da área central dos cadastros-->

				<!--Inicio da área lateral das consultas-->
				<div class="col-sm-7 mb-5 mt-3 pl-2 border rounded bg-dark border-warning">
					<div class="table-responsive"><!--Inicio da Div da table Responsive-->

						<table class="table table-sm text-white"><!--Inicio da Tabela-->
							<thead class="table-dark">
								<tr>
									<th>Nome</th>
									<th>Telefone</th>
									<th>Restrições Alimentar</th>
									<th>Preferencias</th>
									<th colspan="1"></th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($readClientes as $modelcli) { ?>
									<tr>

										<td id="modelcli_<?= $modelcli->idcliente ?>">
											<?= $modelcli->nome ?>
										</td>

										<td id="modelcli_<?= $modelcli->idcliente ?>">
											<?= $modelcli->contacto ?>
										</td>

										<td id="modelcli_<?= $modelcli->idcliente ?>">
											<?= $modelcli->restric_alimen ?>
										</td>

										<td id="modelcli_<?= $modelcli->idcliente ?>">
											<?= $modelcli->preferencias ?>
										</td>

										<td>
											<a href="cliente_User.php?idup=<?= $modelcli->idcliente ?>" class="fas fa-edit text-info" ></a>
										</td>
										<!--<td>
											<i class="fas fa-trash text-danger" onclick="removerCliente(<?= $modelcli->idcliente ?>)" style="cursor: pointer;"></i>
										</td>-->
									</tr>

								<?php } ?>
							</tbody>
						</table><!--Fim da Tabela-->

					</div><!--Inicio da Div da table Responsive-->
				</div><!--Fim da área lateral das consultas-->

			</div><!--Fim da Row-->
		</section><!--Fim do Corpo do App-->

	<!--Inicio do Rodapé do App-->
	<footer>
		<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3" style="margin-top: 211px;">
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
	<script src="../js/RHM.js"></script>
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>
