<?php
	require_once "classes/db/DBCliente.php";
	
	class Cliente extends DBCliente
	{
		private $idCli;
		private $nomeCli;
		private $cpfCli;
		private $telCli;
		private $dataNasc;
		
		public function setidCli($valor)
		{
			$this->idCli = $valor;
		}
		
		public function getidCli()
		{
			return $this->idCli;
		}
		
		public function setnomeCli($valor)
		{
			$this->nomeCli = $valor;
		}
		
		public function getnomeCli()
		{
			return $this->nomeCli;
		}
		
		public function setcpfCli($valor)
		{
			$this->cpfCli = $valor;
		}
		
		public function getcpfCli()
		{
			return $this->cpfCli;
		}

		public function settelCli($valor)
		{
			$this->telCli = $valor;
		}
		
		public function gettelCli()
		{
			return $this->telCli;
		}
		
		public function setdataNasc($valor)
		{
			$this->dataNasc = $valor;
		}
		
		public function getdataNasc()
		{
			return $this->dataNasc;
		}
		
		public function inserir()
		{
			return parent::DBInserir($this);
		}
		
		public function listar()
		{
			return parent::DBListar();
		}

		public function atualizar()
        {
            return parent::DBAtualizar($this);
		}
		
		public function buscar($idCli)
        {
            return parent::DBBuscar($idCli);
        }
		public function excluir($idCli)
        {
            return parent::DBExcluir($idCli);
        }
	}
?>