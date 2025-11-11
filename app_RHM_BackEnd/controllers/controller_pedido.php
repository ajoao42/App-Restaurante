<?php
	
	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_pedido.php';
	require_once '../../app_RHM_private/services/service_pedido.php';
	//require '../../../htdocs/app_RHM_public/sessao/validar_acesso.php';

	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelPedido();
	$service = new ClssPedido($conn, $model);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para o cadastrar os pedidos ao sistema*/
	if ($accao === 'creatPedido')
	{
		if (!empty($_POST['cliente']) && !empty($_POST['mesa']) && !empty($_POST['qtd']) && !empty($_POST['status']) && !empty($_POST['total']) && !empty($_POST['menu']))
		{
			if (isset($_POST['cliente']) && isset($_POST['mesa']) && isset($_POST['qtd']) && isset($_POST['status']) && isset($_POST['total']) && isset($_POST['menu']))
			{
				$model->__set('idreserva', $_POST['cliente']);
				$model->__set('idmesa', $_POST['mesa']);
				$model->__set('quantidade', $_POST['qtd']);
				$model->__set('status', $_POST['status']);
				$model->__set('total', $_POST['total']);
				$model->__set('idmenu', $_POST['menu']);
				$service->cadastrarPedido();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: pedido_User.php?inclusao=save');
				}
				else
				{							
					header('Location: pedido.php?inclusao=save');
				}	
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
			{
				header('Location: pedido_User.php?inclusao=erro1');
			}
			else
			{							
				header('Location: pedido.php?inclusao=erro1');
			}
		}
	}
	/*Condição para a visualização dos pedidos no sistema*/
	elseif ($accao === 'readPedido')
	{

		$readPedido = $service->consultarPedido();
	}
	/*Condição para a actualização dos pedidos no sistema*/
	elseif ($accao === 'updatePedido')
	{
		if (!empty($_POST['cliente']) && !empty($_POST['mesa']) && !empty($_POST['qtd']) && !empty($_POST['status']) && !empty($_POST['total']) && !empty($_POST['menu']))
		{
			if (isset($_POST['cliente']) && isset($_POST['mesa']) && isset($_POST['qtd']) && isset($_POST['status']) && isset($_POST['total']) && isset($_POST['menu']))
			{
				$model->__set('idreserva', $_POST['cliente']);
				$model->__set('idmesa', $_POST['mesa']);
				$model->__set('quantidade', $_POST['qtd']);
				$model->__set('status', $_POST['status']);
				$model->__set('total', $_POST['total']);
				$model->__set('idmenu', $_POST['menu']);
				$model->__set('idpedido', $_POST['id']);
				$service->actualizarPedido();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: pedido_User.php?inclusao=update');
				}
				else
				{							
					header('Location: pedido.php?inclusao=update');
				}
			}
		}
		else
		{
			if ($_SESSION['status'] != 'Adm')
			{
				header('Location: pedido_User.php?inclusao=erro1');
			}
			else
			{							
				header('Location: pedido.php?inclusao=erro1');
			}
		}
	}
	/*Condição para cancelar os pedidos do sistema*/
	elseif ($accao === 'deletePedido')
	{
		$model->__set('idpedido', $_GET['id']);
		$service->removerPedido();
		if ($_SESSION['status'] != 'Adm')
		{
			header('Location: pedido_User.php?inclusao=delete');
		}
		else
		{							
			header('Location: pedido.php?inclusao=delete');
		}
	}

?>