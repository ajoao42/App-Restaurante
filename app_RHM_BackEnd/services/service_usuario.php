<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_usuario.php';

	/*Declaração da InterfaceUsuario com as funções essenciais para a Clss*/
	interface UsuarioInterface
	{
		public function logarUsuario();
		public function cadastrarUsuario();
		public function consultarUsuario();
		public function actualizarUsuario();
		public function removerUsuario();
		public function pesquisarUsuario($id); 
	}
	
	/*Declaração da ClssUsuario e a implementação do UsuarioInterface*/
	class ClssUsuario implements UsuarioInterface 
	{
		private $conexao;
		private $modeluser; 
		
		function __construct(ClssConexao $conexao, ClssModelUsuario $modeluser)
		{
			$this->conexao = $conexao->conectar();
			$this->modeluser = $modeluser;
		}

		public function logarUsuario() //Função para Logar o usuário ao sistema
		{
			try
			{

				$query = "SELECT status,username, senha FROM tb_usuario WHERE username = :username AND senha = :senha ";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':username', $this->modeluser->__get('username'));
				$stmt->bindValue(':senha', $this->modeluser->__get('senha'));
				$stmt->execute();
				
				if ($stmt->rowCount() == 1)
				{
					$dados = $stmt->fetch(PDO::FETCH_OBJ); 
					$_SESSION['usuario'] = $dados->username;
					$_SESSION['status'] = $dados->status;			
					return true;
				}
				else
				{
					return false;	
				}
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao logar no sistema ".$e->getMessage()."</p>";
			}
		}

		public function verificarStatus() //Função para a verificação dos status
		{
			try
			{
				$query = "SELECT status FROM tb_usuario WHERE status = 'Adm'";

				$res = array();
				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				return $res;
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o registro ".$e->getMessage()."</p>";
			}
		}

		public function cadastrarUsuario() //Função para cadastrar o usuário ao sistema
		{
			try
			{

				$query = "INSERT INTO tb_usuario(nome, email, telefone, username, senha, status) VALUES (:nome, :email, :telefone, :username, :senha, :status)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':nome', $this->modeluser->__get('nome'));
				$stmt->bindValue(':email', $this->modeluser->__get('email'));
				$stmt->bindValue(':telefone', $this->modeluser->__get('telefone'));
				$stmt->bindValue(':username', $this->modeluser->__get('username'));
				$stmt->bindValue(':senha', $this->modeluser->__get('senha'));
				$stmt->bindValue(':status', $this->modeluser->__get('status'));
				$stmt->execute();

			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a guardar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarUsuario() //Função para consultar o usuário no sistema
		{
			try
			{
				
				$query = "SELECT * FROM tb_usuario ORDER BY nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a consultar o registro ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarUsuario($id) //Função para a consulta dos usuários para a actualização
		{
			try
			{
				
				$query = "SELECT * FROM `tb_usuario` WHERE iduser = :id";

				$res = array();
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id',$id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				return $res;
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o registro ".$e->getMessage()."</p>";
			}
		}

		public function actualizarUsuario() //Função para actualizar o usuário ao sistema
		{
			try
			{
				$query = "UPDATE tb_usuario SET nome = :nome, email = :email, telefone =       :telefone, username = :username, senha = :senha, status = :status 
									WHERE iduser = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':nome', $this->modeluser->__get('nome'));
				$stmt->bindValue(':email', $this->modeluser->__get('email'));
				$stmt->bindValue(':telefone', $this->modeluser->__get('telefone'));
				$stmt->bindValue(':username', $this->modeluser->__get('username'));
				$stmt->bindValue(':senha', $this->modeluser->__get('senha'));
				$stmt->bindValue(':status', $this->modeluser->__get('status'));
				$stmt->bindValue(':id', $this->modeluser->__get('iduser'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a actualizar o registro ".$e->getMessage()."</p>";
			}
		}

		public function removerUsuario() //Função para apagar o usuário do sistema
		{
			try
			{
		
				$query = "DELETE FROM tb_usuario WHERE iduser = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->modeluser->__get('iduser'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a deletar o registro ".$e->getMessage()."</p>";
			}
		}

	}
	
?>