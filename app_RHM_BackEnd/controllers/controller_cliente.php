<?php
	
	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_cliente.php';
	require_once '../../app_RHM_private/services/service_cliente.php';
	//require_once '../app_RHM_public/sessao/validar_acesso.php';

	/*Instanciando as classes para sua utilização*/
	$cone = new ClssConexao();
	$model = new ClssModelCliente();
	$service = new ClssCliente($cone, $model);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para o cadastrar os clientes ao sistema*/
	if ($accao === 'creatCliente')
	{
		if (isset($_POST['nome']) && isset($_POST['tlf']) && isset($_POST['restricoes']) && isset($_POST['preferencia']))
		{
			if (!empty($_POST['nome']) && !empty($_POST['tlf']) && !empty($_POST['restricoes']) && !empty($_POST['preferencia'])) 
			{
				$model->__set('nome', $_POST['nome']);
				$model->__set('telefone', $_POST['tlf']);
				$model->__set('restricoes', $_POST['restricoes']);
				$model->__set('preferencia', $_POST['preferencia']);				
				$service->cadastrarCliente();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: cliente_User.php?inclusao=save');
				}
				else
				{							
					header('Location: cliente.php?inclusao=save');
				}				
			}
			else
			{
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: cliente_User.php?inclusao=erro1');
				}
				else
				{							
					header('Location: cliente.php?inclusao=erro1');
				}	
			}
		}
	}
	/*Condição para a visualização dos clientes no sistema*/
	else if ($accao === 'readCliente')
	{
		
		$readClientes = $service->consultarCliente();
	}
	/*Condição para a actualização dos clientes no sistema*/
	else if ($accao === 'updateCliente')
	{
		if (!empty($_POST['nome']) && !empty($_POST['tlf']) && !empty($_POST['restricoes']) && !empty($_POST['preferencia'])) 
		{
			if (isset($_POST['nome']) && isset($_POST['tlf']) && isset($_POST['restricoes']) && isset($_POST['preferencia']))
			{
				$model->__set('nome', $_POST['nome']);
				$model->__set('telefone', $_POST['tlf']);
				$model->__set('restricoes', $_POST['restricoes']);
				$model->__set('preferencia', $_POST['preferencia']);	
				$model->__set('idcliente',$_POST['id']);			
				$service->actualizarCliente();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: cliente_User.php?inclusao=update');
				}
				else
				{							
					header('Location: cliente.php?inclusao=update');
				}	
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
				{
					header('Location: cliente_User.php?inclusao=erro1');
				}
				else
				{							
					header('Location: cliente.php?inclusao=erro1');
				}	
		}
	}
	/*Condição para deletar os clientes do sistema*/
	else if ($accao === 'deleteCliente')
	{

		$model->__set('idcliente', $_GET['id']);
		$service->removerCliente();
		if ($_SESSION['status'] != 'Adm')
		{
			header('Location: cliente_User.php?inclusao=delete');
		}
		else
		{							
			header('Location: cliente.php?inclusao=delete');
		}	
	}

?>
