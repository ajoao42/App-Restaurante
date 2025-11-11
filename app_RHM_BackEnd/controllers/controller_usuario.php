<?php
	
	/*Requisitanto os ficheiros do usuario externos*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_usuario.php';
	require_once '../../app_RHM_private/services/service_usuario.php';
	require '../../app_RHM_public/sessao/validar_acesso.php';
	
	/*Instanciando as classes para sua utilização*/
	$conn = new ClssConexao();
	$model = new ClssModelUsuario();
	$service = new ClssUsuario($conn, $model);
	$status = $service->verificarStatus();

	/*Declaração de variaveis*/
	$accao = isset($_GET['accao']) ? $_GET['accao'] : $accao;

	/*Condição para a validação das credencias dos usuários ao sistema*/
	if ($accao === 'logar')
	{
		if (isset($_POST['username']) && isset($_POST['senha']))
		{
			if (!empty($_POST['username']) && !empty($_POST['senha']))
			{
				$model->__set('username', $_POST['username']);
				$model->__set('senha', $_POST['senha']);

				if ($service->logarUsuario())
				{
					$usuario_autenticado = true;
				
					if ($usuario_autenticado) 
					{
						$_SESSION['autenticado'] = 'SIM';
						/*Condição para validação do tipo de usuário no sistema*/
						if ($_SESSION['status'] != 'Adm')
						{
							header('Location:home_User.php');
						}
						else
						{							
							header('Location:home.php');
						}
					}
					else
					{
						$_SESSION['autenticado'] = 'NAO';
						header('Location:index.php?login=erro1');
					}
				}
			}
			else
			{
				header('Location:index.php?login=erro2');
			}
		}
	}
	/*Condição para o cadastrar os usuários ao sistema*/
	elseif ($accao === 'creatUser')
	{
		if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['tlf']) && !empty($_POST['username']) && !empty($_POST['status']) && !empty($_POST['senha']) && !empty($_POST['consenha'])) 
		{
				if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['tlf']) && isset($_POST['username']) && isset($_POST['status']) && isset($_POST['senha']) && isset($_POST['consenha']))
			{

				$model->__set('nome', $_POST['nome']);
				$model->__set('email', $_POST['email']);
				$model->__set('telefone', $_POST['tlf']);
				$model->__set('username', $_POST['username']);
				$model->__set('status', $_POST['status']);			

				if ($_POST['senha'] != $_POST['consenha'])
				{
					header('Location: usuario.php?inclusao=erro2');
				}
				else
				{
					$model->__set('senha', $_POST['senha']);
					//echo $_POST['senha'];
				}

				$service->cadastrarUsuario();
				header('Location: usuario.php?inclusao=save');
			}
		}
		else
		{
			header('Location: usuario.php?inclusao=erro1');
		}
	}
	/*Condição para a visualização dos usuários no sistema*/
	else if ($accao === 'readUser')
	{

		$reads = $service->consultarUsuario();
	}
	/*Condição para a actualização dos usuários no sistema*/
	else if ($accao === 'updateUser')
	{
		if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['tlf']) && !empty($_POST['username']) && !empty($_POST['status']) && !empty($_POST['senha']) && !empty($_POST['consenha']) && !empty($_POST['id']))
		{
			 if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['tlf']) && isset($_POST['username']) && isset($_POST['status']) && isset($_POST['senha']) && isset($_POST['consenha']) && isset($_POST['id']))
			{

				$model->__set('nome', $_POST['nome']);
				$model->__set('email', $_POST['email']);
				$model->__set('telefone', $_POST['tlf']);
				$model->__set('username', $_POST['username']);
				$model->__set('status', $_POST['status']);
				$model->__set('iduser', $_POST['id']);				

				if ($_POST['senha'] === $_POST['consenha'])
				{
					$model->__set('senha', $_POST['senha']);
				}
				else
				{
					header('Location: usuario.php?inclusao=erro2');
				}

				$service->actualizarUsuario();
				header('Location: usuario.php?inclusao=update');
			}
		}
		else
		{
			header('Location: usuario.php?inclusao=erro1');
		}
	}
	/*Condição para deletar os usuários do sistema*/
	else if ($accao === 'deleteUser')
	{
		$model->__set('iduser', $_GET['id']);
		$service->removerUsuario();
		header('Location: usuario.php?inclusao=delete');
	}

?>

