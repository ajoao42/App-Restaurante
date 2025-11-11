<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_menu.php';

	/*Declaração da InterfaceMenu com as funções essenciais para a Clss*/
	interface MenuInterface
	{
		public function cadastrarMenu();
		public function consultarMenu();
		public function actualizarMenu();
		public function removerMenu();
	}

	/*Declaração da ClssMenu e a implementação do MenuInterface*/
	class ClssMenu implements MenuInterface
	{
		private $conexao;
		private $model;
		
		function __construct(ClssConexao $conexao, ClssModelMenu $model)
		{
			$this->conexao = $conexao->conectar();
			$this->model = $model;
		}

		public function pesquisarProduto()
		{
			try 
			{
				$query = "SELECT * FROM tb_produto ORDER BY nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
				
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o registro ".$e->getMessage()."</p>";
			}
		}

		public function cadastrarMenu()
		{
			try 
			{
				$query = "INSERT INTO tb_item_menu (idproduto, nome_menu, preco, descricao) VALUES (:produto, :menu, :preco, :descricao)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':produto', $this->model->__get('idproduto'));
				$stmt->bindValue(':menu', $this->model->__get('menu'));
				$stmt->bindValue(':preco', $this->model->__get('preco'));
				$stmt->bindValue(':descricao', $this->model->__get('descricao'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao cadastrar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarMenu()
		{
			try 
			{
				$query = "SELECT M.iditem, P.idproduto, P.nome, P.preco ,M.nome_menu, M.preco,				M.descricao FROM tb_item_menu as M
									LEFT JOIN tb_produto as P ON p.idproduto = M.idproduto 
									ORDER BY P.nome ASC ";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
				
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a consultar o registro ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarMenu($id)
		{
			try
			{
				
				$query = "SELECT M.iditem, P.idproduto, P.nome, M.nome_menu, M.preco, 
								M.descricao FROM tb_item_menu as M
								LEFT JOIN tb_produto as P ON p.idproduto = M.idproduto 
								WHERE iditem = :id";

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

		public function actualizarMenu() //Função para editar e actualizar o menu
		{
			try 
			{
				$query = "UPDATE tb_item_menu SET idproduto = :produto, nome_menu = :menu, preco = :preco, descricao = :descricao WHERE iditem= :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':produto', $this->model->__get('idproduto'));
				$stmt->bindValue(':menu', $this->model->__get('menu'));
				$stmt->bindValue(':preco', $this->model->__get('preco'));
				$stmt->bindValue(':descricao', $this->model->__get('descricao'));
				$stmt->bindValue(':id', $this->model->__get('idmenu'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao actualizar o registro ".$e->getMessage()."</p>";
			}
		}

		public function removerMenu() //Função para cancelar o menu
		{
			try 
			{
				$query = "DELETE FROM tb_item_menu WHERE iditem = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->model->__get('idmenu'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao cancelar o registro ".$e->getMessage()."</p>";
			}
		}

	}


?>