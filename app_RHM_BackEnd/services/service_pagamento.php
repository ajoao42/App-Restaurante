<?php
	
	//Requisão de arquivos externos para a conexao e o model (Métodos mágicos)
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_pagamento.php';

	/*Declaração das funções essenciais a não faltar na ClssPagamento*/
	interface PagamentoInterface
	{
		public function cadastrarPagamento();
		public function consultarPagamento();
		public function pesquisarCliente();
		public function cadastrarFactura();
		public function consultarFactura($id);
		public function actualizarPagamento();
		public function removerPagamento();
	}

	/*Declaração da ClssPagamento e a implementação da InterfacePagamento*/
	class ClssPagamento implements PagamentoInterface
	{
		private $conexao;
		private $model;
		
		function __construct(ClssConexao $conexao, ClssModelPagamento $model)
		{
			$this->conexao = $conexao->conectar();
			$this->model = $model;
		}

		public function pesquisarCliente() //Função para pesquisar o cliente a reservar
		{
			try
			{
				$query = "SELECT P.idpedido, R.idreserva, C.idcliente, C.nome, M.nome_menu, 
									P.qtd, P.status, P.total FROM tb_pedido as P
									LEFT JOIN tb_reserva as R ON R.idreserva = P.idreserva
									LEFT JOIN tb_item_menu as M ON M.iditem = P.iditem_menu
									LEFT JOIN tb_cliente as C ON C.idcliente = R.idcliente 
									WHERE P.status = 'Pronto' ORDER BY C.nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o cliente ".$e->getMessage()."</p>";
			}
		}

		/*PRINCIPIO DA SECÇÃO DA FACTURA*/

		public function cadastrarFactura() //Função para o pagamento do produto
		{
			try 
			{

				$query = "INSERT INTO tb_factura(idpedido, valor_devido, status_pagamento) VALUES (:pedido, :valor, :status)";

				$stmt = $this->conexao->prepare($query);
				//$stmt->bindValue(':pagamento', $id);
				$stmt->bindValue(':pedido', $this->model->__get('idpedido'));
				$stmt->bindValue(':valor', $this->model->__get('valor_devido'));
				$stmt->bindValue(':status', $this->model->__get('status'));
				$stmt->execute();
				
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a cadastrar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarFactura($id) //Função para consultar e gerar a factura
		{
			try
			{
				
				$query = "SELECT F.idfactura, P.idpedido, M.iditem, R.idreserva, R.idcliente,
									C.nome, M.nome_menu, P.qtd, P.total, F.valor_devido, 
									F.status_pagamento, F.data FROM tb_factura as F 
									LEFT JOIN tb_pedido as P ON F.idpedido = P.idpedido
									LEFT JOIN tb_reserva as R ON P.idreserva = R.idreserva
									LEFT JOIN tb_item_menu as M ON P.iditem_menu = M.iditem
									LEFT JOIN tb_cliente as C ON R.idcliente = C.idcliente WHERE F.idfactura = :id";

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

		public function actualizarFactura() //Função para actualizar a Factura
		{
			try 
			{
				$query = "UPDATE tb_factura SET idpagamento = :pagamento, idpedido = :pedido, valor_devido = :valor, status_pagamento = :status WHERE idfactura = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':pagamento', $this->model->__get('idpagamento'));
				$stmt->bindValue(':pedido', $this->model->__get('idpedido'));
				$stmt->bindValue(':valor', $this->model->__get('valor_devido'));
				$stmt->bindValue(':status', $this->model->__get('status'));
				$stmt->bindValue(':id', $this->model->__get('idfactura'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a actualizar o registro ".$e->getMessage()."</p>";
			}
		}

		/*PRINCIPIO DA SECÇÃO DO PAGAMENTO*/

		public function cadastrarPagamento() //Função para o pagamento do produto
		{
			try 
			{
				$query = "INSERT INTO tb_pagamento (valor, status) VALUES (:valor, :status)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':valor', $this->model->__get('valor'));
				$stmt->bindValue(':status', $this->model->__get('status'));
				$stmt->execute();	
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a cadastrar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarPagamento() //Função para a consulta do pagamento
		{
			try 
			{
				$query = "SELECT B.idpagamento, F.idfactura, P.idpedido, M.iditem, R.idreserva			, R.idcliente, C.nome, M.nome_menu, P.qtd, P.total, B.valor, 
								F.valor_devido ,B.status, F.data FROM tb_pagamento as B 
								LEFT JOIN tb_factura as F ON B.idpagamento = F.idpagamento
								LEFT JOIN tb_pedido as P ON F.idpedido = P.idpedido
								LEFT JOIN tb_reserva as R ON P.idreserva = R.idreserva
								LEFT JOIN tb_item_menu as M ON P.iditem_menu = M.iditem
								LEFT JOIN tb_cliente as C ON R.idcliente = C.idcliente";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a consultar o registro ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarPagamento($id) //Função para a consulta do pagamento
		{
			try 
			{
				$query = "SELECT B.idpagamento, F.idfactura, P.idpedido, M.iditem, R.idreserva				, R.idcliente, C.nome, M.nome_menu, P.qtd, P.total, B.valor, 
									B.status, F.data FROM tb_pagamento as B 
									LEFT JOIN tb_factura as F ON B.idpagamento = F.idpagamento
									LEFT JOIN tb_pedido as P ON F.idpedido = P.idpedido
									LEFT JOIN tb_reserva as R ON P.idreserva = R.idreserva
									LEFT JOIN tb_item_menu as M ON P.iditem_menu = M.iditem
									LEFT JOIN tb_cliente as C ON R.idcliente = C.idcliente 
									WHERE B.idpagamento = :id";

				$res = array();
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				return $res;
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a consultar o registro ".$e->getMessage()."</p>";
			}
		}

		public function actualizarPagamento() //Função para actualizar o Pagamento
		{
			try 
			{
				$query = "UPDATE tb_pagamento SET valor = :valor, status = :status WHERE idpagamento = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':valor', $this->model->__get('valor'));
				$stmt->bindValue(':status', $this->model->__get('status'));
				$stmt->bindValue(':id', $this->model->__get('idpagamento'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a actualizar o registro ".$e->getMessage()."</p>";
			}
		}

		public function removerPagamento() //Função para cancelar o pagamento
		{
			try 
			{
				$query = "DELETE FROM tb_pagamento WHERE idpagamento = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->model->__get('idpagamento'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a cancelar o registro ".$e->getMessage()."</p>";
			}
		}

	}

?>