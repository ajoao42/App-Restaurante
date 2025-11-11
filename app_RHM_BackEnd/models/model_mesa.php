<?php
	
	class ClssModelMesa 
	{
		
		private $idmesa;
		private $idreserva;
		private $mesa;
		private $capacidade;

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