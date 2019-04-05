<?php
	require_once "classes/db/DBConexao.php";

	abstract class DBCliente extends DBConexao
	{	
		//DBInserir
        public static function DBInserir(Cliente $cliente)
        {
            $conexao = parent::getDB();
    
            $query = pg_query($conexao, "INSERT INTO cliente (nomeCli, cpf, telefone, dataNasc) 
                                        VALUES ('".$cliente->getnomeCli()."', '".$cliente->getcpfCli()."', '".$cliente->getTelCli()."', '".$cliente->getdataNasc()."')");
                
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

            $query = pg_query($conexao, "SELECT idCli, nomeCli, cpf, telefone, dataNasc FROM cliente ORDER BY idCli");

            return pg_fetch_all($query);
        }

        //DBAtualizar
        public static function DBAtualizar(Cliente $cliente)
        {
            $conexao = parent::getDB();

            $query = pg_query("UPDATE cliente SET nomeCli = '".$cliente->getnomeCli()."', cpf = '".$cliente->getcpfCli()."', telefone = '".$cliente->gettelCli()."', datanasc = '".$cliente->getdataNasc()."' WHERE idcli = ".$cliente->getidCli());
            
            if ($query)
            {
                return "Alterado com sucesso";
            }
            else
            {
                return "Erro ao alterar";
            }
        }

        //Função DBBuscar
        //Função usada quando o usuário clica no link EDITAR da tabela que lista
        //os clientes
        //O objetivo aqui é retornar todos os dados do cliente que teve seu botão
        //EDITAR clicado
        public static function DBBuscar($idCli)
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao,"SELECT idCli, nomeCli, cpf, telefone, dataNasc  FROM cliente 
											WHERE idCli = '".$idCli."'");

            $dataSetCliente = pg_fetch_assoc($query);

            //Será carregado um objeto Cliente
            if($dataSetCliente) {
                $cliente = new Cliente();
                $cliente->setidCli($dataSetCliente["idcli"]);
                $cliente->setnomeCli($dataSetCliente["nomecli"]);
                $cliente->setcpfCli($dataSetCliente["cpf"]);
				$cliente->settelCli($dataSetCliente["telefone"]);
                $cliente->setdataNasc($dataSetCliente["datanasc"]);
   
                return $cliente;
            }

            return false;
        }
		//função para excluir
		public static function DBExcluir($idCli)
        {
            $conexao = parent::getDB();

            $query = pg_query($conexao, "DELETE FROM cliente WHERE idCli = '".$idCli."'");

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
