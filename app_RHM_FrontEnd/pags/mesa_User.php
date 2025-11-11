<?php 
			$accao = 'readMesa'; require 'controller.php'; 
			require_once '../../app_RHM_private/acesso/validar_acesso.php'; 
			require_once '../../app_RHM_private/config/conexao.php';
			require_once '../../app_RHM_private/models/model_mesa.php';
			require_once '../../app_RHM_private/services/service_mesa.php';
			$conn = new ClssConexao();
			$model = new ClssModelMesa();
			$service = new ClssMesa($conn, $model); 
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Mesa</title>
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

	<!--Inicio do Cabeçalho da App-->
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
	</header><!--Fim do Cabeçalho da App-->

	<!--Inicio do Corpo da App-->
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
					<a href="mesa_User.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-table mr-2"></i>Mesa</a>
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

				<h3 class="text-center text-white mb-2 mt-2 border-bottom border-warning">Cadastrar Mesa</h3>

				<!--Validação em php para pesquisar a mesa na BD e actualizar-->
				<?php if (isset($_GET['idup'])) {
							$idupdate = $_GET['idup'];
							$mesa = $service->pesquisarMesa($idupdate); }	?>

				<div class=" form-group text-white"><!--Inicio da Div Formulario-->

					<form action="<?php if(isset($mesa)) { ?> controller.php?accao=updateMesa <?php } else{ ?>controller.php?accao=creatMesa<?php } ?>" method="POST">

						<label for="reserva" class="text-white font-weight-bold mt-2">Reserva</label>
						<select name="reserva" class="form-control mb-4 border border-warning" id="reserva">
							<option value="Null">Selecione uma reserva</option>
							<?php 

								$reserva = $service->pesquisarReserva();

								foreach ($reserva as $rows) 
								{
									echo "<option value=".$rows->idreserva.">".$rows->nome."</option>";
								}
							?>
						</select>

						<label for="mesa" class="text-white font-weight-bold">Nº da Mesa</label>
						<input type="text" name="mesa" class="form-control mb-3 border border-warning" placeholder="Digite o número da Mesa" id="mesa" value="<?php if(isset($mesa)){echo $mesa['mesa'];} ?>">

						<label for="capacidade" class="text-white font-weight-bold">Nº de Lugares</label>
						<input type="text" name="capacidade" class="form-control mb-3 border border-warning" placeholder="Lugares para..." id="capacidade" value="<?php if(isset($mesa)){echo $mesa['capacidade'];} ?>">

						<input type="hidden" name="id" value="<?php if(isset($mesa)){echo $mesa['idmesa'];} ?>">

						<!--Validação em php para notificar registro cadastrado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'save') { ?>

	          <div class="text-white text-justify text-center mt-0 mb-0 bg-success">
	            <i class="fas fa-check fa-white mr-3"></i>Registro inserido com sucesso!
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro actualizado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'update') { ?>

	          <div class="text-white text-justify text-center mt-0 mb-0 bg-info">
	            Registro actualizado com sucesso!
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro deletado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'delete') { ?>

	          <div class="text-white text-justify text-center mt-0 mb-0 bg-danger">
	            Registro deletado com sucesso
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar erro de campos vazios-->
	        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'erro1') { ?>

	          	<div class="text-white text-justify text-center mt-0 mb-0 bg-warning">
	           	 Preenche todos campos para o cadastramento 
	          	</div>

	        	<?php } ?>

						<input type="submit" class="btn btn-warning btn-block mt-4 mb-5 font-weight-bold" value="<?php if(isset($mesa)){echo 'Actualizar';}else{echo 'Cadastrar';} ?>">

					</form>
				</div><!--Inicio da Div Formulario-->
			</div><!--Fim da área central dos cadastros-->

			<!--Inicio da área lateral das consultas-->
			<div class="col-sm-7 mb-5 mt-3 border rounded bg-dark border-warning">

				<div class="table-responsive"><!--Inicio do Div table responsive-->

						<table class="table table-sm text-white"><!--Inicio da Tabela-->
							<thead class="table-dark">
								<tr>
									<th>Cliente</th>
									<th>Nº da Mesa</th>
									<th>Capacidade</th>
									<th colspan="1"></th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($readMesa as $mesa) { ?> 
									<tr>
										<td id="mesa_<?= $mesa->idmesa ?>"><?= $mesa->nome ?></td>
										<td id="mesa_<?= $mesa->idmesa ?>"><?= $mesa->mesa ?></td>
										<td id="mesa_<?= $mesa->idmesa ?>"><?= $mesa->capacidade ?></td>
										
										<td>
											<a href="mesa_User.php?idup=<?= $mesa->idmesa ?>"><i class="fas fa-edit text-info"></i>
											</a>
										</td>
										<!--<td>
											<a href="controller.php?accao=deleteMesa&id=<?= $mesa->idmesa ?>"><i class="fas fa-trash text-danger"></i>
											</a>
										</td>-->
									<?php } ?>
									</tr>
							</tbody>
						</table><!--Fim da Tabela-->
						
				</div><!--Fim do Div table responsive-->
			</div><!--Fim da área lateral das consultas-->

		</div><!--Fim da Row-->
	</section><!--Fim do Corpo da App-->

	<!--Inicio do Rodapé da App-->
	<footer>
		<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3" style="margin-top: 273px;">
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
	</footer><!--Fim do Rodapé da App-->

	<!--Configurações JS-->
	<script src="../js/RHM.js"></script>
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>
