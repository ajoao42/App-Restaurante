<?php 
		$accao = 'readUser'; require 'controller.php';
		require_once '../../app_RHM_private/acesso/validar_acesso.php'; 
		require_once '../../app_RHM_private/config/conexao.php';
		require_once '../../app_RHM_private/models/model_usuario.php';
		require_once '../../app_RHM_private/services/service_usuario.php';
		$conn = new ClssConexao();
		$model = new ClssModelUsuario();
		$service = new ClssUsuario($conn, $model);
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
	<title>Restaurante H. Miradouro - Usuário</title>
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
			<a href="home.php" class="navbar-brand">
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
	<section class="">
		<div class="row mr-0 my-2"><!--Inicio da Row-->

			<!--Inicio da área lateral dos menus-->
			<div class="col-sm-2 mb-5 mt-5">

				<!--Inicio do botão Home-->
				<div class="mt-2 mb-2">
					<a href="home.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-home mr-2"></i>Home</a>
				</div><!--Fim do botão Home-->

				<!--Inicio do botão Usuario -->
				<div class="mt-2 mb-2">
					<a href="usuario.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-user-edit mr-2"></i>Usuario</a> 
				</div><!--Fim do botão Usuario-->

				<!--Inicio do botão Cliente-->
				<div class="mt-2 mb-2">
					<a href="cliente.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-user mr-2"></i>Cliente</a>
				</div><!--Fim do botão Cliente-->

				<!--Inicio do botão Reserva-->
				<div class="mt-2 mb-2">
					<a href="reserva.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-list-alt mr-2"></i>Reserva</a>
				</div><!--Fim do botão Reserva-->

				<!--Inicio do botão Mesa-->
				<div class="mt-2 mb-2">
					<a href="mesa.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-table mr-2"></i>Mesa</a>
				</div><!--Fim do botão Mesa-->

				<!--Inicio do botão Pedido-->
				<div class="mt-2 mb-2">
					<a href="pedido.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-edit mr-2"></i>Pedido</a>
				</div><!--Fim do botão Pedido-->

				<!--Inicio do botão Menu-->
				<div class="mt-2 mb-2">
					<a href="menu.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-book-open mr-2"></i>Menu</a>
				</div><!--Fim do botão Menu-->

				<!--Inicio do botão Produto-->
				<div class="mt-2 mb-2">
					<a href="produto.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-shopping-basket mr-2"></i>Produto</a>
				</div><!--Fim do botão Produto-->

				<!--Inicio do botão Pagamento-->
				<div class="mt-2 mb-2">
					<a href="pagamento.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-credit-card mr-2"></i>Pagamento</a>
				</div><!--Fim do botão Pagamento-->

				<!--Inicio do botão Definição-->
				<div class="mt-2 mb-2">
						<a href="logoff.php" class="btn btn-block btn-dark ml-2">Terminar sessão</a>
				</div><!--Fim do botão Definição-->

			</div><!--Fim da área lateral dos menus-->

			<!--Inicio da área central dos cadastros-->
			<div class="col-sm-3 mb-5 mt-3 border rounded bg-dark border-warning">
				<h4 class="text-center text-white mb-2 mt-2 border-bottom border-warning">Registrar Usuário</h4>

				<!--Condição para ir buscar os registros da BD para actualização-->
				<?php if (isset($_GET['idup'])) {
						$idupdate = $_GET['idup'];
						$usu = $service->pesquisarUsuario($idupdate); }	?>

				<div class=" form-group text-white"><!--Inicio da Div do formulario-->
					<form 
								action="<?php if(isset($usu)) { ?> controller.php?accao=updateUser <?php } else{ ?>controller.php?accao=creatUser<?php } ?>" method="POST">
						<label for="nome" class="text-white font-weight-bold">Nome</label>
						<input type="text" name="nome" class="form-control mb-2 border border-warning" placeholder="Digite o seu nome completo" id="nome" value="<?php if(isset($usu)){echo $usu['nome'];} ?>">

						<label for="email" class="text-white font-weight-bold">Email</label>
						<input type="text" name="email" class="form-control mb-2 border border-warning" placeholder="Digite o seu email" id="email" value="<?php if(isset($usu)){echo $usu['email'];} ?>">

						<label for="tlf" class="text-white font-weight-bold">Telefone</label>
						<input type="text" name="tlf" class="form-control mb-2 border border-warning" placeholder="Digite o telefone" id="tlf" value="<?php if(isset($usu)){echo $usu['telefone'];} ?>">

						<label for="username" class="text-white font-weight-bold">Nome de Usuário</label>
						<input type="text" name="username" class="form-control mb-2 border-warning" placeholder="Digite o seu username" id="username" value="<?php if(isset($usu)){echo $usu['username'];} ?>">

						<label for="status" class="text-white font-weight-bold">Status do Usuário</label>
						<select name="status" class="form-control mb-2 border-warning" id="status">
							<option value="null">Selecione um status para o user</option>
							<option value="User">Usuário(a)</option>
							<option value="Adm">Administrador</option>
						</select>

						<label for="senha" class="text-white font-weight-bold">Senha</label>
						<input type="password" name="senha" class="form-control mb-2 border border-warning" placeholder="Digite a senha" minlength="4" id="senha" value="<?php if(isset($usu)){echo $usu['senha'];} ?>">

						<label for="consenha" class="text-white font-weight-bold">Confirmar Senha</label>
						<input type="password" name="consenha" class="form-control mb-3 border border-warning" placeholder="Confirma a sua senha" minlength="4" id="consenha" value="<?php if(isset($usu)){echo $usu['senha'];} ?>">

						<input type="hidden" name="id" value="<?php if(isset($usu)){echo $usu['iduser'];} ?>">

						<!--Validação em php para notificar registros cadastrados com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'save') { ?>

		        <div class="text-white text-justify text-center mt-0 mb-0 bg-success">
		          <i class="fas fa-check fa-white mr-3"></i>Registro inserido com sucesso!
		        </div>

		      	<?php } ?>

		      	<!--Validação em php para notificar registros actualizado com sucesso-->
		      	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'update') { ?>

		        <div class="text-white text-justify text-center mt-0 mb-0 bg-info">
		          <i class="fas fa-check fa-white mr-3"></i>Registro actualizado com sucesso!
		        </div>

		      	<?php } ?>

		      	<!--Validação em php para notificar sobre usuarios apagados com sucesso-->
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

		      	<!--Validação em php para notificar erro de senha != consenha-->
		      	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'erro2') { ?>

		        	<div class="text-white text-justify text-center mt-0 mb-0 bg-danger">
		         	 A senha inserida é diferente da senha confirmada 
		        	</div>

		      	<?php } ?>

						<input type="submit" class="btn btn-warning btn-block mt-2 mb-5 font-weight-bold" value="<?php if(isset($usu)) {echo('Actualizar');}else{echo('Cadastrar');} ?>">

					</form><!--Fim do Formulario-->
				</div><!--Fim da Div do formulario-->
			</div><!--Fim da área central dos cadastros-->

			<!--Inicio da área lateral das consultas-->
			<div class="col-sm-7 mb-5 mt-3 pl-2 border rounded bg-dark border-warning">

				<div class="table-responsive"><!--Inicio da Div table responsive-->
					<table class="table table-sm text-white"><!--Inicio da table-->

						<thead class="table-dark">
							<tr>
								<th>Nome</th>
								<th>Email</th>
								<th>Telefone</th>
								<th>User</th>
								<th>Senha</th>
								<th>Status</th>
								<th colspan="2"></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($reads as $user) { ?>

								<tr>
									<td id="user<?= $user->iduser ?>"><?= $user->nome ?></td>
									<td id="user<?= $user->iduser ?>"><?= $user->email ?></td>
									<td id="user<?= $user->iduser ?>"><?= $user->telefone ?></td>
									<td id="user<?= $user->iduser ?>"><?= $user->username ?></td>
									<td id="user<?= $user->iduser ?>"><?= $user->senha ?></td>
									<td id="user<?= $user->iduser ?>"><?= $user->status ?></td>
									
									<td>
										<a href="usuario.php?idup=<?= $user->iduser ?>"><i class="fas fa-edit text-info"></i>
										</a>
									</td>

									<td>
										<i class="fas fa-trash text-danger" style="cursor: pointer;" onclick="removerUsuario(<?= $user->iduser ?>)"></i>
									</td>

								</tr>

							<?php } ?>
						</tbody>

					</table><!--Fim da table-->

				</div><!--Fim da Div table responsive-->

			</div><!--Fim da área lateral das consultas-->

		</div><!--Fim da Row-->
	</section><!--Fim do Corpo do App-->

	<!--Inicio do Rodapé da App-->
	<footer>
		<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3 mt-0">
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
