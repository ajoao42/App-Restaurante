<?php
	
	try 
	{		
		//Iniciando Sessão
		session_start();

		//Condição para a validação se o usuário está utenticado ou não
		if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') 
   		{
    		header('Location:index.php?login=erro');
   		}
			
	} 
	catch (Exception $e)
	{
		echo "<p> Ocorreu um erro com a autenticação do usuário ".$e->getMessage()."</p>";
	}
	
  
  
   
   

?>