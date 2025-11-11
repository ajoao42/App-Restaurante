<?php

	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_mesa.php';
	require_once '../../app_RHM_private/services/service_mesa.php';
	//require '../../../htdocs/app_RHM_public/sessao/validar_acesso.php';

	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelMesa();
	$service = new ClssMesa($conn, $model);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para o cadastrar as mesas ao sistema*/
	if ($accao === 'creatMesa')
	{
		if (!empty($_POST['reserva']) && !empty($_POST['mesa']) && !empty($_POST['capacidade'])) 
		{
			if (isset($_POST['reserva']) && isset($_POST['mesa']) && isset($_POST['capacidade']))
			{
				$model->__set('idreserva', $_POST['reserva']);
				$model->__set('mesa', $_POST['mesa']);
				$model->__set('capacidade', $_POST['capacidade']);
				$service->cadastrarMesa();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: mesa_User.php?inclusao=save');
				}
				else
				{							
					header('Location: mesa.php?inclusao=save');
				}	
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
				{
					header('Location: mesa_User.php?inclusao=erro1');
				}
				else
				{							
					header('Location: mesa_User.php?inclusao=erro1');
				}	
		}
	}
	/*Condição para a visualização das mesas no sistema*/
	elseif ($accao === 'readMesa')
	{
		
		$readMesa = $service->consultarMesa();
	}
	/*Condição para a actualização das mesas no sistema*/
	elseif ($accao === 'updateMesa')
	{
		if (!empty($_POST['reserva']) && !empty($_POST['mesa']) && !empty($_POST['capacidade']) && !empty($_POST['id'])) 
		{
			if (isset($_POST['reserva']) && isset($_POST['mesa']) && isset($_POST['capacidade']) && isset($_POST['id']))
			{
				$model->__set('idreserva', $_POST['reserva']);
				$model->__set('mesa', $_POST['mesa']);
				$model->__set('capacidade', $_POST['capacidade']);
				$model->__set('idmesa', $_POST['id']);
				$service->actualizarMesa();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: mesa_User.php?inclusao=update');
				}
				else
				{							
					header('Location: mesa_User.php?inclusao=update');
				}	
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
				{
					header('Location: mesa_User.php?inclusao=erro1');
				}
				else
				{							
					header('Location: mesa_User.php?inclusao=erro1');
				}	
		}
	}
	/*Condição para cancelar as mesas do sistema*/
	elseif ($accao === 'deleteMesa')
	{
		$model->__set('idmesa', $_GET['id']);
		$service->removerMesa();
		if ($_SESSION['status'] != 'Adm')
		{
			header('Location: mesa_User.php?inclusao=delete()');
		}
		else
		{							
			header('Location: mesa_User.php?inclusao=delete');
		}	
	}

?>