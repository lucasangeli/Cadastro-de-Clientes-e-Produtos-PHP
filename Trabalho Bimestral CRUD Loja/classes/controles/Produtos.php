<?php
	require_once "classes/db/DBProduto.php";
	
	class Produto extends DBProduto
	{
		private $idProd;
		private $nomeProd;
		private $qtdProd;
		private $valorProd;
		private $medidaProd;
		
		public function setcodProd($valor)
		{
			$this->codProd = $valor;
		}
		
		public function getcodProd()
		{
			return $this->codProd;
		}
		
		public function setnomeProd($valor)
		{
			$this->nomeProd = $valor;
		}
		
		public function getnomeProd()
		{
			return $this->nomeProd;
		}
		
		public function setqtdProd($valor)
		{
			$this->setqtdProd = $valor;
		}
		
		public function getqtdProd()
		{
			return $this->qtdProd;
		}

		public function setvalorProd($valor)
		{
			$this->valorProd = $valor;
		}
		
		public function getvalorProd()
		{
			return $this->valorProd;
		}
		
		public function setmedidaProd($valor)
		{
			$this->medidaProd = $valor;
		}
		
		public function getmedidaProd()
		{
			return $this->medidaProd;
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
		
		public function buscar($idProd)
        {
            return parent::DBBuscar($idProd);
        }
		public function excluir($idProd)
        {
            return parent::DBExcluir($idProd);
        }
	}
?>