<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_produto.php';

	/*Declaração da InterfaceProduto com as funções essenciais para a Clss*/
	interface ProdutoInterface
	{
		public function cadastrarProduto();
		public function consultarProduto();
		public function actualizarProduto();
		public function removerProduto();
		public function pesquisarProduto($id);
	}

	/*Declaração da ClssProduto e a implementação do UsuarioInterface*/
	class ClssProduto implements ProdutoInterface
	{
		private $conexao;
		private $model;
		
		function __construct(ClssConexao $conexao, ClssModelProduto $model)
		{
			$this->conexao = $conexao->conectar();
			$this->model = $model;
		}

		public function cadastrarProduto() //Função para cadastrar o Produto
		{
			try 
			{
				$query = "INSERT INTO tb_produto(nome, preco) VALUES(:nome, :preco)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':nome', $this->model->__get('nome'));
				$stmt->bindValue(':preco', $this->model->__get('preco'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao cadastrar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarProduto() //Função para consultar o Produto
		{
			try 
			{
				$query = "SELECT idproduto, nome, preco FROM tb_produto";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao consultar o registro ".$e->getMessage()."</p>";
			}
		}
		
		public function pesquisarProduto($id) //Função para visualização dos dados para editar
		{
			try
			{
				
				$query = "SELECT idproduto, nome, preco FROM tb_produto 
									WHERE idproduto = :id";

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

		public function actualizarProduto() //Função para editar o Produto
		{
			try 
			{
				$query = "UPDATE tb_produto SET nome = :nome, preco = :preco WHERE idproduto = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':nome', $this->model->__get('nome'));
				$stmt->bindValue(':preco', $this->model->__get('preco'));
				$stmt->bindValue(':id', $this->model->__get('idproduto'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao editar o registro ".$e->getMessage()."</p>";
			}
		}

		public function removerProduto() //Função para remover o Produto
		{
			try 
			{
				$query = "DELETE FROM tb_produto WHERE idproduto = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->model->__get('idproduto'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao remover o registro ".$e->getMessage()."</p>";
			}
		}
	}

?>