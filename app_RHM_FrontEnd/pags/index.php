<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Login</title>
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
			<div>
				<a href="index.php" style="text-decoration: none;">
					<h3 class="text-white bg-dark font-weight-bold pb-3 pt-2 pl-1">Restaurante <span class="text-warning">Hotel Miradouro</span><i class="fas fa-hotel ml-2"></i></h3>
				</a>
			</div>
		</header><!--Fim do Cabeçalho do App-->

 	<!--Inicio do Corpo do App-->
		<section>
			<div class="container"><!--Inicio do Container-->
				<div class="row mt-5 mb-5"><!--Inicio da Row-->

					<div class="col-sm-6 offset-sm-3 mb-5" id="area-login"><!--Inicio da Área Login-->
						<div class="row mt-5 mb-5 pb-5">

							<div class="col-sm-8 offset-sm-2 mt-5 mb-4 border rounded bg-dark border-warning">

								<h3 class="text-center text-white mb-5 mt-5 border-bottom border-warning">Faça o Login</h3>

								<div class=" form-group"><!--Inicio da Div do formulario-->

									<form action="controller.php?accao=logar" method="POST"><!--Formulario-->

										<label for="username" class="text-white font-weight-bold">Nome de Usuário</label>
										<input type="text" name="username" class="form-control mb-4 border-warning" placeholder="Digite o seu nome de usuário" id="username">

										<label for="senha" class="text-white font-weight-bold">Senha</label>
										<input type="password" name="senha" class="form-control mb-4 border-warning" placeholder="Digite a senha" id="senha">

										<!--Validação em php para erro de usuários inválidos-->
						      	<?php if (isset($_GET['login']) && $_GET['login'] == 'erro') { ?>

						        	<div class="text-white text-justify text-center bg-danger mt-0 mb-0">
						         		Usuario ou senha inválida! 
						        	</div>

						      	<?php } ?>

						      	<!--Validação em php para erro de sessão-->
	                	<?php if (isset($_GET['login']) && $_GET['login'] == 'erro1') { ?>

	                  	<div class="text-white text-justify text-center bg-info mt-0 mb-0">
	                   	 Verifica os dados antes de acessar
	                 	 </div>

	                	<?php } ?>

						      	<!--Validação em php para erro de campos vazios-->
						      	<?php if (isset($_GET['login']) && $_GET['login'] == 'erro2') { ?>

						        	<div class="text-white text-justify text-center bg-warning mt-0 mb-0">
						         	 Preenche todos os campos para o login
						        	</div>

						      	<?php } ?>

										<button type="submit" class="btn btn-warning btn-block mt-2 mb-5"><i class="fas fa-lock-open fa-white mr-2"></i>Entrar</button>

									</form>
								</div><!--Fim da Div do formulario-->

							</div>

						</div>
					</div><!--Fim da Área Login-->

				</div><!--Fim da Row-->			
			</div><!--Fim do Container-->
		</section><!--Fim do Corpo do App-->

	<!--Inicio do Rodapé do App-->
		<footer>
			<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3 mb-0">
				<div class="row">

					<!--Inicio da Área Esquerda do Rodapé-->
					<div class="col-sm-9">
						<p class="text-white font-weight-bold mb-0">Restaurante<span class="text-warning"> Hotel Miradouro</span>: seu app de sabores inigualáveis</p>
						<span class="">Todos direitos reservado by: Grande Grupo</span> &copy; Copyright 2023
					</div><!--Fim da Área Esquerda do Rodapé-->

					<!--Inicio da Área Direita do Rodapé-->
					<div class="col-sm-3">
						<span class="text-white font-weight-bold">Contactos:</span><br>

						<a href="###" style="text-decoration: none;"><!--Facebook-->
							<img src="../img/facebook.svg" class="img-fluid ml-2" width="25" height="25">
						</a>

						<a href="###" style="text-decoration: none;"><!--GitHub-->
							<img src="../img/github.svg" class="img-fluid ml-2" width="25" height="25">
						</a>

						<a href="###" style="text-decoration: none;"><!--Gmail-->
							<img src="../img/google.svg" class="img-fluid ml-2" width="25" height="25">
						</a>

						<a href="###" style="text-decoration: none;"><!--WhatsApp-->
							<img src="../img/whatsapp.svg" class="img-fluid ml-2" width="25" height="25">
						</a>

					</div><!--Fim da Área Direita do Rodapé-->

				</div>
			</div>
		</footer><!--Fim do Rodapé do App-->

	<!--Configurações JS-->
		<script src="js/jquery-3.3.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

</body>
</html>
