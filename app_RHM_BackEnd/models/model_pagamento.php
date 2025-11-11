<?php
	
	class ClssModelPagamento 
	{
		
		private $idpagamento;
		private $idfactura;
		private $status;
		private $valor;
		private $valor_devido;
		private $idpedido;

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