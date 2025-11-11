<?php
	
	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_reserva.php';
	require_once '../../app_RHM_private/services/service_reserva.php';
	//require '../../../htdocs/app_RHM_public/sessao/validar_acesso.php';

	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelReserva();
	$service = new ClssReserva($conn, $model);

	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para o cadastrar as reservas ao sistema*/
	if ($accao === 'creatReserva')
	{
		if (!empty($_POST['cliente']) && !empty($_POST['data']) && !empty($_POST['hora']) && !empty($_POST['lugares']))
		{
			if (isset($_POST['cliente']) && isset($_POST['data']) && isset($_POST['hora']) && isset($_POST['lugares']))
			{
				$model->__set('idcliente',$_POST['cliente']);
				$model->__set('data',$_POST['data']);
				$model->__set('hora',$_POST['hora']);
				$model->__set('lugares',$_POST['lugares']);
				$service->cadastrarReserva();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: reserva_User.php?inclusao=save');
				}
				else
				{							
					header('Location: reserva.php?inclusao=save');
				}
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
			{
				header('Location: reserva_User.php?inclusao=erro1');
			}
			else
			{							
				header('Location: reserva.php?inclusao=erro1');
			}
		}
	}
	/*Condição para a visualização das reservas no sistema*/
	elseif ($accao === 'readReserva')
	{
		
		$readReserva = $service->consultarReserva();
	}
	/*Condição para a actualização das reservas ao sistema*/
	elseif ($accao === 'updateReserva')
	{
		if (!empty($_POST['cliente']) && !empty($_POST['data']) && !empty($_POST['hora']) && !empty($_POST['lugares']) && !empty($_POST['id']))
		{
			if (isset($_POST['cliente']) && isset($_POST['data']) && isset($_POST['hora']) && isset($_POST['lugares']) && isset($_POST['id']))
			{
				$model->__set('idcliente',$_POST['cliente']);
				$model->__set('data',$_POST['data']);
				$model->__set('hora',$_POST['hora']);
				$model->__set('lugares',$_POST['lugares']);
				$model->__set('idreserva',$_POST['id']);
				$service->actualizarReserva();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: reserva_User.php?inclusao=update');
				}
				else
				{							
					header('Location: reserva.php?inclusao=update');
				}
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
			{
				header('Location: reserva_User.php?inclusao=erro1');
			}
			else
			{							
				header('Location: reserva.php?inclusao=erro1');
			}
		}
	}
	/*Condição para cancelar as reservas dos clientes*/
	elseif ($accao === 'deleteReserva')
	{
		$model->__set('idreserva', $_GET['id']);
		$service->removerReserva();
		if ($_SESSION['status'] != 'Adm')
		{
			header('Location: reserva_User.php?inclusao=delete()');
		}
		else
		{							
			header('Location: reserva.php?inclusao=delete()');
		}
	}
?>