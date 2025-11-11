<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_cliente.php';
	
	/*Declaração da InterfaceCliente com as funções essenciais para a Clss*/
	interface ClienteInterface
	{
		public function cadastrarCliente();
		public function consultarCliente();
		public function actualizarCliente();
		public function removerCliente();
		public function pesquisarCliente($id);
	}

	/*Declaração da ClssCliente e a implementação do ClienteInterface*/
	class ClssCliente implements ClienteInterface 
	{
		private $conexao;
		private $modeluser;
		
		function __construct(ClssConexao $conexao, ClssModelCliente $modeluser)
		{
			$this->conexao = $conexao->conectar();
			$this->modeluser = $modeluser;
		}

		public function cadastrarCliente() //Função para cadastrar o Cliente ao sistema
		{
			try
			{

				$query = "INSERT INTO tb_cliente(nome, contacto, restric_alimen, preferencias) VALUES(:nome, :telefone, :restricoes, :preferencia)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':nome', $this->modeluser->__get('nome'));
				$stmt->bindValue(':telefone', $this->modeluser->__get('telefone'));
				$stmt->bindValue(':restricoes', $this->modeluser->__get('restricoes'));
				$stmt->bindValue(':preferencia', $this->modeluser->__get('preferencia'));
				$stmt->execute();

			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a guardar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarCliente() //Função para consultar o Cliente no sistema
		{
			try
			{
				$query = "SELECT * FROM tb_cliente ORDER BY nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a consultar o registro ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarCliente($id)
		{
			try
			{
				
				$query = "SELECT * FROM tb_cliente WHERE idcliente = :id";

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

		public function actualizarCliente() //Função para actualizar o Cliente ao sistema
		{
			try
			{
				$query = "UPDATE tb_cliente SET nome = :nome, contacto = :telefone, restric_alimen = :restricoes, preferencias = :preferencia WHERE  idcliente = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':nome', $this->modeluser->__get('nome'));
				$stmt->bindValue(':telefone', $this->modeluser->__get('telefone'));
				$stmt->bindValue(':restricoes', $this->modeluser->__get('restricoes'));
				$stmt->bindValue(':preferencia', $this->modeluser->__get('preferencia'));
				$stmt->bindValue(':id', $this->modeluser->__get('idcliente'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a actualizar o registro ".$e->getMessage()."</p>";
			}
		}

		public function removerCliente() //Função para apagar o Cliente do sistema
		{
			try
			{
				$query = "DELETE FROM tb_cliente WHERE idcliente = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->modeluser->__get('idcliente'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a deletar o registro ".$e->getMessage()."</p>";
			}
		}

	}

?>