<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_pedido.php';

	/*Declaração da InterfacePedido com as funções essenciais para a Clss*/
	interface PedidoInterface
	{
		public function cadastrarPedido();
		public function consultarPedido();
		public function actualizarPedido();
		public function removerPedido();
		public function pesquisarPedido($id);
	}

	/*Declaração da ClssPedido e a implementação do PedidoInterface*/
	class ClssPedido implements PedidoInterface
	{
		private $conexao;
		private $model;
		
		function __construct(ClssConexao $conexao, ClssModelPedido $model)
		{
			$this->conexao = $conexao->conectar();
			$this->model = $model;
		}

		public function pesquisarCliente() //Função para pesquisar o cliente a reservar
		{
			try
			{
				$query = "SELECT R.idreserva, C.idcliente, C.nome  FROM tb_reserva as R 
									LEFT JOIN tb_cliente as C ON C.idcliente = R.idcliente";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o cliente ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarMesa() //Função para pesquisar a mesa a reservar
		{
			try
			{
				$query = "SELECT * FROM tb_mesa";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o cliente ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarMenu() //Função para pesquisar o menu a reservar
		{
			try
			{
				$query = "SELECT iditem, idproduto, nome_menu, preco, descricao 
						  FROM tb_item_menu ORDER BY nome_menu ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o cliente ".$e->getMessage()."</p>";
			}
		}

		public function cadastrarPedido() //Função para cadastrar o Pedido
		{
			try 
			{
				$query = "INSERT INTO tb_pedido(idreserva, idmesa, qtd, status, total, iditem_menu) VALUES (:reserva, :mesa, :qtd, :status, :total, :menu)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(":reserva", $this->model->__get('idreserva'));
				$stmt->bindValue(":mesa", $this->model->__get('idmesa'));
				$stmt->bindValue(":qtd", $this->model->__get('quantidade'));
				$stmt->bindValue(":status", $this->model->__get('status'));
				$stmt->bindValue(":total", $this->model->__get('total'));
				$stmt->bindValue(":menu", $this->model->__get('idmenu'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao cadastrar o pedido ".$e->getMessage()."</p>";
			}
		}

		public function consultarPedido() //Função para consultar o Pedido
		{
			try 
			{
				$query = "SELECT P.idpedido, P.idreserva , R.idcliente, M.idmesa, 
									P.iditem_menu, C.nome, M.mesa, M.capacidade, I.nome_menu, P.qtd, I.descricao, P.status, P.total FROM tb_pedido as P 
									LEFT JOIN tb_reserva AS R ON R.idreserva = P.idreserva 
									LEFT JOIN tb_mesa AS M ON M.idmesa = P.idmesa 
									LEFT JOIN tb_item_menu AS I ON I.iditem = P.iditem_menu 
									LEFT JOIN tb_cliente as C ON R.idcliente = C.idcliente 
									ORDER BY C.nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao consultar o pedido ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarPedido($id) //Função para visualização dos dados para editar
		{
			try
			{
				
				$query = "SELECT P.idpedido, R.idreserva , R.idcliente, M.idmesa, 
                  P.iditem_menu, C.nome, M.mesa, M.capacidade, I.nome_menu,P.qtd, 
                  I.descricao, P.status, P.total FROM tb_pedido as P 
                  LEFT JOIN tb_reserva AS R ON R.idreserva = P.idpedido 
                  LEFT JOIN tb_mesa AS M ON M.idmesa = P.idmesa 
                  LEFT JOIN tb_item_menu AS I ON I.iditem = P.iditem_menu 
                  LEFT JOIN tb_cliente as C ON R.idcliente = C.idcliente WHERE P.idpedido = :id";

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

		public function actualizarPedido() //Função para editar o Pedido
		{
			try 
			{
				$query = "UPDATE tb_pedido SET idreserva = :idres, idmesa = :idmes, qtd = :qtd, status = :status, total = :total, iditem_menu = :idmenu WHERE idpedido = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(":idres", $this->model->__get('idreserva'));
				$stmt->bindValue(":idmes", $this->model->__get('idmesa'));
				$stmt->bindValue(":qtd", $this->model->__get('quantidade'));
				$stmt->bindValue(":status", $this->model->__get('status'));
				$stmt->bindValue(":total", $this->model->__get('total'));
				$stmt->bindValue(":idmenu", $this->model->__get('idmenu'));
				$stmt->bindValue(":id", $this->model->__get('idpedido'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao editar o pedido ".$e->getMessage()."</p>";
			}
		}

		public function removerPedido() //Função para remover o Pedido
		{
			try 
			{
				$query = "DELETE FROM tb_pedido WHERE idpedido = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(":id", $this->model->__get('idpedido'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro ao remover o pedido ".$e->getMessage()."</p>";
			}
		}
	}
?>		