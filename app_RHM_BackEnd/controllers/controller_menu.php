<?php
	
	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_menu.php';
	require_once '../../app_RHM_private/services/service_menu.php';
	//require '../../../htdocs/app_RHM_public/sessao/validar_acesso.php';

	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelMenu();
	$service = new ClssMenu($conn, $model);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para o cadastrar os menus ao sistema*/
	if ($accao === 'creatMenu')
	{
		if (!empty($_POST['produto']) && !empty($_POST['menu']) && !empty($_POST['preco']) && !empty($_POST['desc']))
		{
			if (isset($_POST['produto']) && isset($_POST['menu']) && isset($_POST['preco']) && isset($_POST['desc']))
			{
				$model->__set('idproduto', $_POST['produto']);
				$model->__set('menu', $_POST['menu']);
				$model->__set('preco', $_POST['preco']);
				$model->__set('descricao', $_POST['desc']);
				$service->cadastrarMenu();
				header('Location: menu.php?inclusao=save');
			}
		}
		else
		{
			header('Location: menu.php?inclusao=erro1');
		}
	}
	/*Condição para a visualização dos menus no sistema*/
	elseif ($accao === 'readMenu')
	{
		
		$readMenu = $service->consultarMenu();
	}
	/*Condição para a actualização dos menus no sistema*/
	elseif ($accao === 'updateMenu')
	{
		if (!empty($_POST['produto']) && !empty($_POST['menu']) && !empty($_POST['preco']) && !empty($_POST['desc']) && !empty($_POST['id']))
		{
			if (isset($_POST['produto']) && isset($_POST['menu']) && isset($_POST['preco']) && isset($_POST['desc']) && isset($_POST['id']))
			{
				$model->__set('idproduto', $_POST['produto']);
				$model->__set('menu', $_POST['menu']);
				$model->__set('preco', $_POST['preco']);
				$model->__set('descricao', $_POST['desc']);
				$model->__set('idmenu', $_POST['id']);
				$service->actualizarMenu();
				header('Location: menu.php?inclusao=update');
			}
		}
		else
		{
			header('Location: menu.php?inclusao=erro1');
		}
	}
	/*Condição para deletar os menus do sistema*/
	elseif ($accao === 'deleteMenu')
	{
		$model->__set('idmenu', $_GET['id']);
		$service->removerMenu();
		header('Location: menu.php?inclusao=delete');
	}

?>