<?php
	
	//Códigos para terminar a sessão iniciada pelo usuário
	session_start();
	session_destroy();
	/*Após terminar a sessão o código abaixo redirecionar para a pagina de login*/
	header('Location:index.php');
?>