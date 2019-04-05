<?php
    require_once "classes/controles/Produtos.php";

	$produto = new Produto();
	
    //Inserir funcionário
	//Verificar se alguém clicou em submit
    if (isset($_POST["cadastrar"])){
		
		//o post pega os nomes dos inputs
		$produto->setnomeProd($_POST["nome"]);
		$produto->setqtdProd($_POST["quantidade"]);
        $produto->setvalorProd($_POST["valor"]);
		$produto->setmedidaProd($_POST["medida"]);
        
        if ($produto->inserir() == "Inserido com sucesso"){
            header("Location: cadProdutos.php");
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
                $produto_busca = $produto->buscar($_GET["idprod"]);
                break;
				
			case "excluir": 
                if ($produto->excluir($_GET["idprod"]) == "Excluído com sucesso"){
                    header("Location: cadProdutos.php");
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
		$produto->setcodProd($_POST["codigo"]);
        $produto->setnomeProd($_POST["nome"]);
		$produto->setqtdProd($_POST["quantidade"]);
        $produto->setvalorProd($_POST["valor"]);
		$produto->setmedidaProd($_POST["medida"]);

        if($produto->atualizar() == "Alterado com sucesso"){
            header("Location: cadProdutos.php");
        }else{
            echo '<script type="text/javascript">alert("Erro em alterar");</script>';
        }
    }


?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>CADASTRO DE PRODUTOS EM PHP</title>
		<meta name="author" content="produtos">
		<meta name="description" content="Sistemas de Informação Manda">
	</head>
	<body>
		<form action="" method="POST">
			<!-- espaço para o código da fruta no formulário -->
			<div>CÓDIGO</div>
			<input type="text" name="codigo"
				value="<?=(isset($produto_busca))?($produto_busca->getcodProd()):("")?>"
				>
			
            <div>NOME</div>
            <input type="text" name="nome"
                value="<?=(isset($produto_busca))?($produto_busca->getnomeProd()):("")?>"
                >
            

            <div>QUANTIDADE</div>
            <input type="text" name="quantidade" 
            	value="<?=(isset($produto_busca))?($produto_busca->getqtdProd()):("")?>"
            	>

             <div>VALOR</div>
            <input type="text" name="valor"
            	 value="<?=(isset($produto_busca))?($produto_busca->getvalorProd()):("")?>"
            	 >
				 
			<div>UNIDADE DE MEDIDA</div>
            <input type="text" name="medida"
            	 value="<?=(isset($produto_busca))?($produto_busca->getmedidaProd()):("")?>"
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
                <td>QUANTIDADE</td>
                <td>VALOR</td>
				<td>UNIDADE DE MEDIDA</td>

            </tr>
            <?php foreach((array)$produto->listar() as $item){ ?>
                <tr>
				<!--esses campos tem que ser iguais aos da tabela do postgres-->
                    <td><?=$item["idprod"]?></td>
                    <td><?=$item["nomeprod"]?></td>
                    <td><?=$item["quantidade"]?></td>
                    <td><?=$item["valor"]?></td>
					<td><?=$item["unimedida"]?></td>

                    <td>
                        <a href="?acao=editar&idprod=<?=$item["idprod"]?>" title="Editar">Editar</a>
						<td>
                        <a href="?acao=excluir&idprod=<?=$item["idprod"]?>"
                            title="Excluir"
                            onclick="return confirm('Tem certeza que deseja deletar esse registro?');">
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