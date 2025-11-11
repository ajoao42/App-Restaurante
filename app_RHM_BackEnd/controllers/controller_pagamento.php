<?php

/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_pagamento.php';
	require_once '../../app_RHM_private/services/service_pagamento.php';

	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelPagamento();
	$service = new ClssPagamento($conn, $model);
	
	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para a visualização dos registros Pagamento*/
	if ($accao === 'readPagamento')
	{
		
		$readPagamento = $service->consultarPagamento();
	}
	/*Condição para a actualização dos registros Pagamento*/
	elseif ($accao === 'updatePagamento')
	{
		if (!empty($_POST['valor']) && !empty($_POST['valor_devido']) && !empty($_POST['status']) && !empty($_POST['pedido']) && !empty($_POST['idpag']) && !empty($_POST['idfa']))
		{
			if (isset($_POST['valor']) && isset($_POST['valor_devido']) && isset($_POST['status']) && isset($_POST['cliente']) && isset($_POST['idpag']) && isset($_POST['idfa'])) 
			{
				$model->__set('valor', $_POST['valor']);
				$model->__set('valor_devido', $_POST['valor_devido']);
				$model->__set('status', $_POST['status']);
				$model->__set('idpedido', $_POST['pedido']);
				$model->__set('idpagamento', $_POST['idpag']);
				$model->__set('idfactura', $_POST['idfa']);
				$service->actualizarPagamento();
				$service->actualizarFactura();
				if ($_SESSION['status'] != 'Adm')
				{
					header('Location: pagamento_User.php?inclusao=update');
				}
				else
				{							
					header('Location: pagamento.php?inclusao=update');
				}	
			}
		}
		else
		{
			header('Location: pagamento.php?inclusao=erro1');
		}
	}
	/*Condição para o cancelamento dos registros Pagamento*/
	elseif ($accao === 'deletePagamento')
	{
		$model->__set('idpagamento', $_GET['id']);
		$service->removerPagamento();
		if ($_SESSION['status'] != 'Adm')
		{
			header('Location: pagamento_User.php?inclusao=delete');
		}
		else
		{							
			header('Location: pagamento.php?inclusao=delete');
		}	
	}

?>