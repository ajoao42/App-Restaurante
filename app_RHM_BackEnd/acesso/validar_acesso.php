<?php
	
	try 
	{
		if ($_SESSION) {
			session_abort();
		}
		
		if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') 
		{
			header('Location:index.php?login=erro');
		}		
	} 
	catch (Exception $e)
	{
		echo "<p> Ocorreu um erro com a sessão do usuário ".$e->getMessage()."</p>";
	}
   

?>