<?php
	require_once "classes/db/DBConexao.php";

	abstract class DBProduto extends DBConexao
	{	
		//DBInserir
        public static function DBInserir(Produto $produto)
        {
            $conexao = parent::getDB();
    
            $query = pg_query($conexao, "INSERT INTO produto (nomeProd, quantidade, valor, uniMedida) 
                                         VALUES ('".$produto->getnomeProd()."', '".$produto->getqtdProd()."', '".$produto->getvalorProd()."', '".$produto->getmedidaProd()."')");
                
            if ($query)
            {
                return "Inserido com sucesso";
            }
            else
            {
                return "Erro ao inserir";
            }
        }
		
		public static function DBListar()
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao, "SELECT idProd, nomeProd, quantidade, valor, uniMedida FROM produto ORDER BY idProd");

            return pg_fetch_all($query);
        }

        //DBAtualizar
        public static function DBAtualizar(Produto $produto)
        {
            $conexao = parent::getDB();

            $query = pg_query("UPDATE produto SET nomeProd = '".$produto->getnomeProd()."', quantidade = '".$produto->getqtdProd()."', valor = '".$produto->getvalorProd()."', uniMedida = '".$produto->getmedidaProd()."' WHERE idprod = ".$produto->getcodProd());
            
            if ($query)
            {
                return "Alterado com sucesso";
            }
            else
            {
                return "Erro ao alterar";
            }
        }

 
        public static function DBBuscar($idProd)
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao,"SELECT idProd, nomeProd, quantidade, valor, uniMedida FROM produto
                                         WHERE idProd = '".$idProd."'");

            $dataSetProduto = pg_fetch_assoc($query);

            if($dataSetProduto) {
                $produto = new Produto();
                $produto->setcodProd($dataSetProduto["idprod"]);
                $produto->setnomeProd($dataSetProduto["nomeprod"]);
                $produto->setqtdProd($dataSetProduto["quantidade"]);
				$produto->setvalorProd($dataSetProduto["valor"]);
                $produto->setmedidaProd($dataSetProduto["unimedida"]);
   
                return $produto;
            }

            return false;
        }
		//função para excluir
		public static function DBExcluir($idProd)
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao, "DELETE FROM produto WHERE idProd = '".$idProd."'");

            if ($query)
            {
                return "Excluído com sucesso";
            }
            else
            {
                return "Erro ao excluir";
            }
        }
	}
			
?>
