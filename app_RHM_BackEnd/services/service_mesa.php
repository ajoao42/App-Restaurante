<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_mesa.php';
	
	/*Declaração da InterfaceMesa com as funções essenciais para a Clss*/
	interface MesaInterface
	{
		public function cadastrarMesa();
		public function consultarMesa();
		public function actualizarMesa();
		public function removerMesa();
		public function pesquisarMesa($id);
	}

	/*Declaração da ClssMesa e a implementação do MesaInterface*/
	class ClssMesa implements MesaInterface
	{
		private $conexao;
		private $model;
		
		function __construct(ClssConexao $conexao, ClssModelMesa $model)
		{
			$this->conexao = $conexao->conectar();
			$this->model = $model;
		}

		public function pesquisarReserva() //Função para pesquisar o cliente a reservar
		{
			try
			{
				$query = "SELECT R.idreserva, C.idcliente, C.nome FROM tb_cliente as C 
									LEFT JOIN tb_reserva as R ON R.idcliente = C.idcliente 
									ORDER BY C.nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o registro ".$e->getMessage()."</p>";
			}
		}

		public function cadastrarMesa() //Função para o cadastramento da mesa
		{
			try 
			{
				$query = "INSERT INTO tb_mesa(idreserva, mesa, capacidade) VALUES(:idreserva, :mesa, :capacidade)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':idreserva', $this->model->__get('idreserva'));
				$stmt->bindValue(':mesa', $this->model->__get('mesa'));
				$stmt->bindValue(':capacidade', $this->model->__get('capacidade'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a cadastrar o registro ".$e->getMessage()."</p>";
			}
		}

		public function consultarMesa() //Função para a consulta da mesa
		{
			try 
			{
				$query = "SELECT  M.idmesa, M.idreserva, C.nome, M.mesa ,M.capacidade 
									FROM tb_mesa as M INNER JOIN tb_reserva as R 
									ON R.idreserva = M.idreserva 
									INNER JOIN tb_cliente as C ON R.idcliente = C.idcliente 
									ORDER BY C.nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a consultar o registro ".$e->getMessage()."</p>";
			}
		}

		public function pesquisarMesa($id)
		{
			try
			{
				
				$query = "SELECT * FROM tb_mesa WHERE idmesa = :id";

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

		public function actualizarMesa() //Função para actualizar a mesa
		{
			try 
			{
				$query = "UPDATE tb_mesa SET idreserva = :idreserva, mesa = :mesa, 
									capacidade = :capacidade WHERE idmesa = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':idreserva', $this->model->__get('idreserva'));
				$stmt->bindValue(':mesa', $this->model->__get('mesa'));
				$stmt->bindValue(':capacidade', $this->model->__get('capacidade'));
				$stmt->bindValue(':id', $this->model->__get('idmesa'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a actualizar o registro ".$e->getMessage()."</p>";
			}
		}

		public function removerMesa() //Função para cancelar a mesa
		{
			try 
			{
				$query = "DELETE FROM tb_mesa WHERE idmesa = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->model->__get('idmesa'));
				$stmt->execute();
			} 
			catch(Exception $e)
			{
				echo "<p> Ocorreu um erro a cancelar o registro ".$e->getMessage()."</p>";
			}
		}
	}

?>