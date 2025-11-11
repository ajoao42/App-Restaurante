<?php
	
	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_produto.php';
	require_once '../../app_RHM_private/services/service_produto.php';

	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelProduto();
	$service = new ClssProduto($conn, $model);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para o cadastros dos produtos ao sistema*/
	if ($accao === 'creatProduto')
	{
		if (!empty($_POST['produto']) && !empty($_POST['preco']))
		{
			if (isset($_POST['produto']) && isset($_POST['preco']))
			{
				$model->__set('nome', $_POST['produto']);
				$model->__set('preco', $_POST['preco']);
				$service->cadastrarProduto();
				header('Location: produto.php?inclusao=save');
			}
		}
		else
		{
			header('Location: produto.php?inclusao=erro1');
		}
	}
	/*Condição para a visualização dos produtos no sistema*/
	elseif ($accao === 'readProduto')
	{

		$readProduto = $service->consultarProduto();
	}
	/*Condição para a actualização dos produtos no sistema*/
	elseif ($accao === 'updateProduto')
	{
		if (!empty($_POST['produto']) && !empty($_POST['preco']) && !empty($_POST['id']))
		{
			if (isset($_POST['produto']) && isset($_POST['preco']) && isset($_POST['id']))
			{
				$model->__set('nome', $_POST['produto']);
				$model->__set('preco', $_POST['preco']);
				$model->__set('idproduto', $_POST['id']);
				$service->actualizarProduto();
				header('Location: produto.php?inclusao=update');
			}
		}
		else
		{
			header('Location: produto.php?inclusao=erro1');
		}
	}
	/*Condição para deletar os produtos do sistema*/
	elseif ($accao === 'deleteProduto')
	{
		$model->__set('idproduto', $_GET['id']);
		$service->removerProduto();
		header('Location: produto.php?inclusao=delete');
	}



?>