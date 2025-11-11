<?php
	
	// 1. Criando a conexão com a base de dados (for MySQL)
	$host = 'localhost';
	$database = 'db_app_rhm';
	$user = 'root';
	$password = '';
	$dsn = "mysql:host=$host;dbname=$database;charset=utf8";
	$pdo = new PDO($dsn, $user, $password);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	if ($accao === 'creatPagamento')
	{		
		if (!empty($_POST['pedido']) && !empty($_POST['valor']) && !empty($_POST['valor_devido']) && !empty($_POST['status']))
		{
			if (isset($_POST['pedido']) && isset($_POST['valor']) && isset($_POST['valor_devido']) && isset($_POST['status'])) 
			{
				// 2. Inserindo os arquivos na tabela Pagamento'
				$query_user = "INSERT INTO tb_pagamento (valor, status) VALUES (:valor, :status)";

				$stmt_user = $pdo->prepare($query_user);
				$stmt_user->bindValue(':valor', $_POST['valor']);
				$stmt_user->bindValue(':status', $_POST['status']);
				$stmt_user->execute();	

				// 3. Verificando e Pegando o último Id Pagamento inserido
				$id = $pdo->lastInsertId(); // Retorna valor interiro

				// 4. Esse condição verificar se realmente existe o último id para ser inserido na factura
				if ($id) 
				{
					$query_fat = "INSERT INTO tb_factura(idpagamento, idpedido, valor_devido, status_pagamento) VALUES (:pagamento, :pedido, :valor, :status)";

					$stmt_fat = $pdo->prepare($query_fat);
					$stmt_fat->bindValue(':pagamento', $id);
					$stmt_fat->bindValue(':pedido', $_POST['pedido']);
					$stmt_fat->bindValue(':valor', $_POST['valor_devido']);
					$stmt_fat->bindValue(':status', $_POST['status']);
					$stmt_fat->execute();
				}
				else{
					echo "Falha a pegar o último Id da tablea pagamento";
				}
				
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: pagamento_User.php?inclusao=save');
				}
				else
				{							
					header('Location: pagamento.php?inclusao=save');
				}	
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
			{
				header('Location: pagamento_User.php?inclusao=erro1');
			}
			else
			{							
				header('Location: pagamento.php?inclusao=erro1');
			}	
		}		
	}
		
?>