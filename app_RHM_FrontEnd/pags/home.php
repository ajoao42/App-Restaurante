<?php require '../sessao/validar_acesso.php'; ?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Restaurante H. Miradouro - Menu</title>
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
  				<a href="home.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark active"><i class="fas fa-home mr-2"></i>Home</a>
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

  			<!--Inicio do botão Pedido-->
  			<div class="mt-2 mb-2">
  				<a href="menu.php" class="btn btn-warning btn-block ml-2 font-weight-bold text-dark"><i class="fas fa-book-open mr-2"></i>Menu</a>
  			</div><!--Fim do botão Pedido-->

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
  				<a href="logoff.php" class="btn btn-dark btn-block ml-2">Terminar sessão</a>
  			</div><!--Fim do botão Definição-->

  		</div><!--Fim da área lateral dos menus-->

  		<!--Inicio da área central-->
  		<div class="col-sm-10 mb-3 mt-3 border rounded bg-dark border-warning">
  		
  			<div class="d-flex mt-3 mb-3">
  				<img src="../img/demo2.png" class="img-fluid">
  			</div>

  			<div class="d-flex mt-4 mb-4 ">
  				<p class="m-auto h4 font-weight-bold text-white">Bem-vindo ao Restaurante Hotel Miradouro Srº(a): <i class="text-warning"><?= $_SESSION['usuario']; ?></i></p>
  			</div>		

  			<div id="carousel-controles" class="carousel slide mt-3" data-ride="carousel"><!--Carousel-->
  				<h5 class="bg-secondary text-center mb-3">Venha provar os nossos pratos</h5>
          <div class=""><!--Inner-->
            <div class="row carousel-inner m-auto"><!--Inicio da Row-->

            	<!--Inicio da 1º imagem-->
            	<div class="col-sm-3 carousel-item active border rounded bg-dark border-warning mb-5">
            		<div class="bg-dark"><!--Primeira imagem-->
            			<p class="text-right text-white">Favorito <i class="fas fa-heart text-danger ml-1" style="cursor: pointer;"></i></p>          			
            		<img src="../img/Arroz com batata frita.jpg" class="img-fluid" width="500" height="500">
              	<p class="text-white text-center">
              		- Bife Brasileiro -<br>
              		<i style="font-size: 12px;">
              			Bife com arroz de alfaçe, batata frita, farinha e acompanhado com feijão<br>
              			Por apenas: 5.000,00
              		</i> 
              	</p> 
            		</div>
            	</div><!--Fim da 1º imagem-->

            	<!--Inicio da 2º imagem-->
            	<div class="col-sm-3 carousel-item active border rounded bg-dark border-warning mb-5">
            		<div class="bg-dark"><!--Primeira imagem-->
            			<p class="text-right text-white">Favorito <i class="fas fa-heart text-danger ml-1" style="cursor: pointer;"></i></p>         			
            		<img src="../img/10006454.jpg" class="img-fluid" width="500" height="500">
              	<p class="text-white text-center">
                  - Bitoque -<br>
                  <i style="font-size: 12px;">
                    Arroz acompanhado com feijão preto entrecosto gelhado, salado e ovo frito<br>
                    Por apenas: 4.000,00
                  </i> 
                </p> 
            		</div>
            	</div><!--Fim da 2º imagem-->

            	<!--Inicio da 3º imagem-->
            	<div class="col-sm-3 carousel-item active border rounded bg-dark border-warning mb-5">
            		<div class="bg-dark"><!--Primeira imagem-->
            			<p class="text-right text-white">Favorito <i class="fas fa-heart text-danger ml-1" style="cursor: pointer;"></i></p>          			
            		<img src="../img/10138368.jpg" class="img-fluid" width="500" height="500">
              	<p class="text-white text-center">
                  - Feijoada Brasileira -<br>
                  <i style="font-size: 12px;">
                    Feijoada de feijão preto com arroz, farinha e salada verde<br>
                    Por apenas: 5.000,00
                  </i> 
                </p> 
            		</div>
            	</div><!--Fim da 3º imagem-->

            	<!--Inicio da 4º imagem-->
            	<div class="col-sm-3 carousel-item active border rounded bg-dark border-warning mb-5">
            		<div class="bg-dark">
            			<p class="text-right text-white">Favorito <i class="fas fa-heart text-danger ml-1" style="cursor: pointer;"></i></p>         			
            		<img src="../img/massa.jpg" class="img-fluid" width="500" height="500">
              	<p class="text-white text-center">
                  - Spargueth Francesa -<br>
                  <i style="font-size: 12px;">
                    Spargueth francesa com frango a caril e batata frita<br>
                    Por apenas: 3.000,00
                  </i> 
                </p> 
            		</div>
            	</div> <!--Fim da 4º imagem-->        	

            </div><!--Fim da Row-->   
          </div><!--Fim do Inner-->

          <!--Botão do Previus-->
          <a href="#carousel-controles" class="carousel-control-prev" data-slide="prev">	<span class="carousel-control-prev-icon"></span>
          </a>

          <!--Botão do Next-->
          <a href="#carousel-controles" class="carousel-control-next" data-slide="next">	<span class="carousel-control-next-icon"></span>
          </a>

        </div><!--Fim do Carousel com controles-->

  		</div><!--Fim da área central-->

  	</div><!--Fim da Row-->
  </section><!--Fim do Corpo da App-->

  <!--Inicio do Rodapé da App-->
  <footer>
  	<div class="bg-dark text-white pt-2 pb-2 pl-2 pr-3" style="margin-top: 33px;">
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
