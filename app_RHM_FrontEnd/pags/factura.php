<?php 
			$accao = 'readPagamento'; require 'controller.php'; 
			require_once '../../app_RHM_private/acesso/validar_acesso.php';
			require_once '../../app_RHM_private/config/conexao.php';
			require_once '../../app_RHM_private/models/model_pagamento.php';
			require_once '../../app_RHM_private/services/service_pagamento.php';
			$conn = new ClssConexao();
			$model = new ClssModelPagamento();
			$service = new ClssPagamento($conn, $model);

			if (isset($_GET['idfa']))
			{
				$id = $_GET['idfa'];
				$rows = $service->consultarFactura($id);
			}	
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Factura</title>
	<!--Bootstrap-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!--Fontawesome-->
	<link rel="stylesheet"  href="../fontawesome/css/all.css">
	<!--Configurações Customizadas-->
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<!--Tags do icone da logo no navegador-->
  <link rel="icon" href="../img/Icone228x.ico">
</head>
<body>

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
	          <a class="nav-link btn btn-outline-light btn-sm text-warning" href="pagamento.php">Voltar</a>
	      </li>
	      
	    </ul><!--Fim do Usuário logoado ao sistema-->

		</nav>
	</header><!--Fim do Cabeçalho da App-->

	<!--Inicio do Corpo da App-->
	<section>	
		<div class="container"><!--Inicio do container-->
			<div class="row mx-0 my-2"><!--Inicio da Row-->

				<!--Inicio da área lateral das consultas-->
				<div class="col-sm-10 offset-sm-1 mb-5 mt-3">
					<div class="text-center">
						<i class="fas fa-hotel h2"></i>
						<p class="text-uppercase font-weight-bold mb-1">Hotel Miradouro</p>
						<p class="text-uppercase font-weight-bold mb-1">Restaurante Hotel Miradouro</p>
						<p class="mb-1">Cuanza Norte, Municipio de Cazengo, Ndalatando, Rua direita Luanda-Malanje</p>
						<p class="mb-1">TEL:+244 999 000 000 / +244 923 000 000</p>
						<p class="mb-1">NIF:0000000012345</p>
						<p class="text-uppercase">Cuanza Norte - Angola</p>
					</div>

					<div class="mt-4 border-bottom border-dark">
						<p class="font-weight-bold text-center mt-2 mb-0">Recibo de Prestação de Serviço</p><br>
						<span class="font-weight-bold mb-2">Data: </span><i class="ml-2"><?= date('Y/m/d H:i:s');?></i><br>	
						<span class="font-weight-bold mb-1">Operador de caixa:</span><i class="ml-2"><?= $_SESSION['usuario']; ?></i>								
					</div>

					<div class="mb-3 mt-2">
						<div class="table-responsive"><!--Inicio da Div tabela responsive-->

							<table class="table table-sm"><!--Inicio da tabela-->
								<thead class="table-dark text-center">
									<tr>
										<th>Cliente</th>
										<th>Pedido</th>
										<th>Qtd</th>
										<th>Valor a pagar</th>
										<th>Valor pago</th>
										<th>Status</th>
										<th>Data</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td class="text-center"><?= $rows['nome']?></td>
										<td class="text-center"><?= $rows['nome_menu']?></td>
										<td class="text-center"><?= $rows['qtd']?></td>
										<td class="text-center"><?= $rows['total']?></td>
										<td class="text-center"><?= $rows['valor_devido']?></td>
										<td class="text-center"><?= $rows['status_pagamento']?></td>
										<td class="text-center"><?= $rows['data']?></td>
									</tr>
								</tbody>
							</table><!--Fim da tabela-->

						</div><!--Fim da Div tabela responsive-->
					</div>

					<p class="text-center border-top border-dark">...............Obrigado volte sempre...............</p>
				</div><!--Fim da área lateral das consultas-->

			</div><!--Fim da Row-->
		</div><!--Fim do container-->
	</section><!--Fim do Corpo da App-->

<!--Configurações JS-->
<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>