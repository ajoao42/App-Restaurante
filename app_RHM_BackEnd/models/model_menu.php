<?php
	
	
	class ClssModelMenu
	{
		private $idmenu;
		private $idproduto;
		private $menu;
		private $preco;
		private $descricao;

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