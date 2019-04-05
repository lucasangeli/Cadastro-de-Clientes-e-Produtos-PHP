<?php
    require_once "classes/controles/Clientes.php";

	//O nome da classe de controle é Fruta, com a primeira maiúscula então
	$cliente = new Cliente();
	
    //Inserir funcionário
	//Verificar se alguém clicou em submit
    if (isset($_POST["cadastrar"])){
		
		//aqui vai os nomes que estao no input
		$cliente->setnomeCli($_POST["nome"]);
		$cliente->setcpfCli($_POST["cpf"]);
        $cliente->settelCli($_POST["telefone"]);
		$cliente->setdataNasc($_POST["nasc"]);
        
        if ($cliente->inserir() == "Inserido com sucesso"){
            header("Location: cadClientes.php");
        } else {
            echo '<script type="text/javascript">alert("Erro ao inserir");</script>';
        }
    }

    	 //Selecionar o funcionário ao clicar no link EDITAR
    //e carregar seus dados nos inputs do formulário desta página
    //lembrando que os inputs são carregados no código que existe direto no
    //input, ver código colocado no value de cada input
    if (isset($_GET["acao"])){
        switch ($_GET["acao"]){
            case "editar":
                $cliente_busca = $cliente->buscar($_GET["idcli"]);
                break;
				
			case "excluir": 
                if ($cliente->excluir($_GET["idcli"]) == "Excluído com sucesso"){
                    header("Location: cadClientes.php");
                } else {
                    echo '<script type="text/javascript">alert("Erro ao deletar");</script>';
                }
                break;
        }
    }
	


    //Alterar funcionário
    //Ao clicar no botão submit do formulário
    //será verificado se o valor dele é alterar,
    //sendo alterar ele fará a chamada para o método atualizar
    if(isset($_POST["alterar"])){
		
		//Quando vamos alterar algo no banco, usamos a chave primária
		//como filtro no WHERE do UPDATE
		//Então você precisa passar para o objeto $fruta o código da fruta
		//Veja que no form eu coloquei mais um input type chamado de codigo
		$cliente->setidCli($_POST["codigo"]);
		
		//ESSA PARTE PEGA OS NOMES DOS INPUTS
        $cliente->setnomeCli($_POST["nome"]);
		$cliente->setcpfCli($_POST["cpf"]);
        $cliente->settelCli($_POST["telefone"]);
		$cliente->setdataNasc($_POST["nasc"]);

        if($cliente->atualizar() == "Alterado com sucesso"){
            header("Location: cadClientes.php");
        }else{
            echo '<script type="text/javascript">alert("Erro em alterar");</script>';
        }
    }


?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>Cadastro de Clientes</title>
		<meta name="author" content="clientes">
		<meta name="description" content="Sistemas de Informação Manda">
	</head>
	<body>
		<form action="" method="POST">
			<!-- espaço para o código do cliente no formulário -->
			<div>CÓDIGO</div>
			<input type="text" name="codigo"
				value="<?=(isset($cliente_busca))?($cliente_busca->getidCli()):("")?>"
				>
			
            <div>NOME</div>
            <input type="text" name="nome"
                value="<?=(isset($cliente_busca))?($cliente_busca->getnomeCli()):("")?>"
                >
            

            <div>CPF</div>
            <input type="text" name="cpf" 
            	value="<?=(isset($cliente_busca))?($cliente_busca->getcpfCli()):("")?>"
            	>

             <div>TELEFONE</div>
            <input type="text" name="telefone"
            	 value="<?=(isset($cliente_busca))?($cliente_busca->gettelCli()):("")?>"
            	 >

			<div>DATA DE NASCIMENTO</div>
            <input type="text" name="nasc"
            	 value="<?=(isset($cliente_busca))?($cliente_busca->getdataNasc()):("")?>"
            	 >
				 
            <div></div>
			<input type="submit"
                name="<?=(isset($_GET["acao"]) == "editar")?("alterar"):("cadastrar")?>"
                value="<?=(isset($_GET["acao"]) == "editar")?("Alterar"):("Cadastrar")?>"
            >
		</form>

        <div>
        <table>
            <tr>
                <td>CÓDIGO</td>
                <td>NOME</td>
                <td>CPF</td>
                <td>TELEFONE</td>
				<td>DATA DE NASCIMENTO</td>

            </tr>
            <?php foreach((array)$cliente->listar() as $item){ ?>
                <tr>
				<!--esses campos tem que ser iguais aos da tabela do postgres-->
                    <td><?=$item["idcli"]?></td>
                    <td><?=$item["nomecli"]?></td>
                    <td><?=$item["cpf"]?></td>
                    <td><?=$item["telefone"]?></td>
					<td><?=$item["datanasc"]?></td>

                    <td>
                        <a href="?acao=editar&idcli=<?=$item["idcli"]?>" title="Editar">Editar</a>
						<td>
                        <a href="?acao=excluir&idcli=<?=$item["idcli"]?>"
                            title="Excluir"
                            onclick="return confirm('Tem certeza que deseja deletar esse cliente?');">
                            Excluir
                        </a>
                    </td>
                    </td>
                </tr>
            <?php } ?>
        </table>
        </div>
	</body>
</html>