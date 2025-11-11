<?php 
			$accao = 'readProduto'; require 'controller.php'; 
			require_once '../../app_RHM_private/acesso/validar_acesso.php'; 
			require_once '../../app_RHM_private/config/conexao.php';
			require_once '../../app_RHM_private/models/model_produto.php';
			require_once '../../app_RHM_private/services/service_produto.php';
			$conn = new ClssConexao();
			$model = new ClssModelProduto();
			$service = new ClssProduto($conn, $model);
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Produto</title>
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
	</header><!--Fim do Cabeçalho da App-->

	<!--Inicio do Corpo da App-->
	<section>
		<div class="row mx-0 my-2"><!--Inicio da Row-->

			<!--Inicio da área lateral dos menus-->
			<div class="col-sm-2 mb-5 mt-5">

				<!--Inicio do botão Home-->
				<div class="mt-2 mb-2">
					<a href="home.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-home mr-2"></i>Home</a>
				</div><!--Fim do botão Home-->

				<!--Inicio do botão Usuario -->
				<div class="mt-2 mb-2">
					<a href="usuario.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-user-edit mr-2"></i>Usuario</a> 
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
					<a href="produto.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-shopping-basket mr-2"></i>Produto</a>
				</div><!--Fim do botão Produto-->

				<!--Inicio do botão Pagamento-->
				<div class="mt-2 mb-2">
					<a href="pagamento.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-credit-card mr-2"></i>Pagamento</a>
				</div><!--Fim do botão Pagamento-->

				<!--Inicio do botão Definição-->
				<div class="mt-2 mb-2">
					<a href="logoff.php" class="btn btn-dark btn-block ml-2">Terminar sessão</a>
				</div><!--Fim do botão Definição-->

			</div><!--Fim da área lateral dos menus-->

			<!--Inicio da área central dos cadastros-->
			<div class="col-sm-3 mb-5 mt-3 border rounded bg-dark border-warning">
				<h3 class="text-center text-white mb-2 mt-2 border-bottom border-warning">Cadastrar Produto</h3>

				<!--Condição para ir buscar os registro na BD para a actualização-->
				<?php if (isset($_GET['idup'])) {
							$idupdate = $_GET['idup'];
							$pro = $service->pesquisarProduto($idupdate); }	?>

				<div class="form-group text-white"><!--Inicio da Div do formulario-->

					<form action="<?php if(isset($pro)) { ?> controller.php?accao=updateProduto <?php } else{ ?> controller.php?accao=creatProduto <?php } ?>" method="POST">

						<label for="produto" class="text-white font-weight-bold mt-2">Produto</label>
						<input type="text" name="produto" class="form-control mb-4 border border-warning" placeholder="Digite o nome do produto" id="produto" value="<?php if(isset($pro)){echo $pro['nome'];} ?>">
						
						<label for="preco" class="text-white font-weight-bold">Preço</label>
						<input type="text" name="preco" class="form-control mb-4 border border-warning" placeholder="Digite o preço do produto" id="preco" value="<?php if(isset($pro)){echo $pro['preco'];} ?>">

						<input type="hidden" name="id" value="<?php if(isset($pro)){echo $pro['idproduto'];} ?>">

						<!--Validação em php para notificar registro cadastrado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'save') { ?>

	          <div class="text-white text-justify text-center mb-0 mt-0 bg-success">
	            <i class="fas fa-check fa-white mr-3"></i>Registro inserido com sucesso!
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro actuazliado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'update') { ?>

	          <div class="text-white text-justify text-center mb-0 mt-0 bg-info">
	            Registro actualizado com sucesso
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar registro deletado com sucesso-->
						<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'delete') { ?>

	          <div class="text-white text-justify text-center mb-0 mt-0 bg-danger">
	            Registro deletado com sucesso
	          </div>

	        	<?php } ?>

	        	<!--Validação em php para notificar erro de campos vazios-->
	        	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 'erro1') { ?>

	          	<div class="text-white text-justify text-center mb-0 mt-0 bg-warning">
	           	 Preenche todos campos para o cadastramento 
	          	</div>

	        	<?php } ?>

						<input type="submit" class="btn btn-warning btn-block mt-4 mb-5 font-weight-bold" value="<?php if(isset($pro)){echo 'Actualizar';}else{echo 'Cadastrar';} ?>">

					</form>
				</div><!--Fim da Div do formulario-->
			</div><!--Fim da área central dos cadastros-->

			<!--Inicio da área lateral das consultas-->
			<div class="col-sm-7 mb-5 mt-3 border rounded bg-dark border-warning">
				<div class="table-responsive"><!--Inicio da Div da tabela responsive-->

						<table class="table table-sm text-white"><!--Inicio da tabela-->
							<thead class="table-dark">
								<tr>
									<th>Produto</th>
									<th>Preço</th>
									<th colspan="2"></th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($readProduto as $produto) { ?>
									
									<tr>
										<td id="produto_<?= $produto->idproduto ?>">
											<?= $produto->nome ?>
										</td>
										<td id="produto_<?= $produto->idproduto ?>">
											<?= $produto->preco ?>
										</td>
																	
										<td>
											<a href="produto.php?idup=<?= $produto->idproduto ?>"><i class="fas fa-edit text-info"></i>
											</a>
										</td>

										<td>
											<a href="controller.php?accao=deleteProduto&id=<?= $produto->idproduto ?>"><i class="fas fa-trash text-danger"></i>
											</a>
										</td>
								<?php } ?>
									</tr>
							</tbody>
						</table><!--Fim da tabela-->

					</div><!--Fim da Div da tabela responsive-->
			</div><!--Fim da área lateral das consultas-->

		</div><!--Fim da Row-->
	</section><!--Fim do Corpo da App-->

	<!--Inicio do Rodapé da App-->
	<footer>
		<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3" style="margin-top: 194px;">
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
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>
