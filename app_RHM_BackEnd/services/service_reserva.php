<?php
	
	/*Requisição dos arquivos externos conexão e model (métodos mágicos)*/
	require_once '../../app_RHM_private/config/conexao.php';
	require_once '../../app_RHM_private/models/model_reserva.php';

	/*Declaração da InterfaceReserva com as funções essenciais para a Clss*/
	interface ReservaInterface
	{
		public function pesquisarCliente();
		public function cadastrarReserva();
		public function consultarReserva();
		public function actualizarReserva();
		public function removerReserva();
		public function pesquisarReserva($id);
	}

	/*Declaração da ClssReserva e a implementação do UsuarioInterface*/
	class ClssReserva implements ReservaInterface
	{
		private $conexao;
		private $model;

		function __construct(ClssConexao $conexao, ClssModelReserva $model)
		{
			$this->conexao = $conexao->conectar();
			$this->model = $model;
		}

		public function pesquisarCliente() //Função para pesquisar o cliente a reservar
		{
			try
			{
				$query = "SELECT * FROM tb_cliente ORDER BY nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a pesquisar o cliente ".$e->getMessage()."</p>";
			}
		}

		public function cadastrarReserva() //Função para cadastar reserva
		{
			try
			{
				$query = "INSERT INTO tb_reserva (idcliente, data, hora, n_lugares) 
									VALUES (:idcliente, :data, :hora, :lugares)";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':idcliente', $this->model->__get('idcliente'));
				$stmt->bindValue(':data', $this->model->__get('data'));
				$stmt->bindValue(':hora', $this->model->__get('hora'));
				$stmt->bindValue(':lugares', $this->model->__get('lugares'));
				$stmt->execute();
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a fazer a reserva ".$e->getMessage()."</p>";
			}
		}

		public function consultarReserva() //Função para as consultas das reservas
		{
			try
			{
				$query = "SELECT R.idreserva, R.idcliente, C.nome, R.data, R.hora, R.n_lugares FROM tb_reserva as R LEFT JOIN tb_cliente as C ON R.idcliente = C.idcliente ORDER BY c.nome ASC";

				$stmt = $this->conexao->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_OBJ);
			} 
			catch (Exception $e)
			{
				
			}
		}

		public function pesquisarReserva($id) //Função para visualização dos dados para editar
		{
			try
			{
				
				$query = "SELECT * FROM tb_reserva WHERE idreserva = :id";

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

		public function actualizarReserva() //Função para editar as reservas cadastradas
		{
			try
			{
				$query = "UPDATE tb_reserva SET idcliente = :cliente, data = :data, hora = :hora, n_lugares = :lugares WHERE idreserva = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':cliente', $this->model->__get('idcliente'));
				$stmt->bindValue(':data', $this->model->__get('data'));
				$stmt->bindValue(':hora', $this->model->__get('hora'));
				$stmt->bindValue(':lugares', $this->model->__get('lugares'));
				$stmt->bindValue(':id', $this->model->__get('idreserva'));
				$stmt->execute();
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro ao actualizar a reserva ".$e->getMessage()."</p>";
			}
		}

		public function removerReserva() //Função para o cancelamento das reservas feitas
		{
			try
			{
				$query = "DELETE FROM tb_reserva WHERE idreserva = :id";

				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(':id', $this->model->__get('idreserva'));
				$stmt->execute();
			} 
			catch (Exception $e)
			{
				echo "<p> Ocorreu um erro a cancelar o registro ".$e->getMessage()."</p>";
			}
		}

	}

?>