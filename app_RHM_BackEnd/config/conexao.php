<?php
	
	class ClssConexao 
	{
		private $server = "localhost";
		private $user = "root";
		private $bdname = "db_app_rhm";
		private $senha = "";
		
		public function conectar()
		{
			try 
			{
				$conexao = new PDO("mysql: host=$this->server; dbname=$this->bdname",
					"$this->user",
					"$this->senha");

				return $conexao;
			} 
			catch (PDOException $e)
			{
				echo "<p> Ocorreu um erro a conectar a database ".$e->getMessage()."</p>";
			}
		}

		protected static function getdb()
		{
			return self::conectar();
		}
		
	}

?>