<?php

	class ClssModelReserva
	{
		
		private $idreserva;
		private $idcliente;
		private $data;
		private $hora;
		private $lugares;

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