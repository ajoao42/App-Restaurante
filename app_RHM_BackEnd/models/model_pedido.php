<?php
	
	class ClssModelPedido 
	{
		private $idpedido;
		private $idmesa;
		private $idreserva;
		private $idmenu;
		private $quantidade;
		private $status;
		private $total;

		public function __get($atributo)
		{
			return $this->$atributo;
		}

		public function __set($atributo, $valor)
		{
			$this->$atributo = $valor;
			return $this;
		}
	}
	
?>