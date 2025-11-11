<?php
	
	class ClssModelProduto
	{
		
		private $idproduto;
		private $nome;
		private $preco;

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