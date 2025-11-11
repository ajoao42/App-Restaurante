<?php

	class ClssModelCliente 
	{
		private $idcliente;
		private $nome;
		private $telefone;
		private $restricoes;
		private $preferencia;

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