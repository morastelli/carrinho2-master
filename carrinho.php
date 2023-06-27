<?php
    include("conecta.php");

    $comando = $pdo->prepare("SELECT * FROM produtos");
    $resultado = $comando->execute();
    
    while ($linhas = $comando->fetch() )
    {
        $nome = $linhas["nome"]; 
        $preco = $linhas["preco"]; 
        $qtd = $linhas["quantidade"];
        $carrinho = $linhas["carrinho"];        
    }

    $number = "number";

    $comando = $pdo->prepare("SELECT * FROM produtos WHERE nome = :nome");
    $comando->bindParam(":nome", $nome);
    $resultado = $comando->execute();

    $comando->bindParam(":quantidade", $quantidade);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <!--ICON NA GUIA-->
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="estiloCarrinho.css">
</head>
<body>
    <!--LOGO E SETA-->
    <div class="logo">
        <a href="telaInicial.html"><img src="setaespeculary.jpg" class="seta"></a>
        <img src="logoetexto.png" class="logoTamanho">
    </div> 
     <!--TÍTULO-->
     <div class="titulo">
         <h2>Seu carrinho</h2>
     </div>
     <div id="prot" class="prot">
        <div name="imagem" id="imagem" class="imagem">
        <?php 
            while ($linhas = $comando->fetch()) 
            {
                $dados_imagem = $linhas["foto"];
                $i = base64_encode($dados_imagem);
                echo("<br> <img src='data:image/jpeg;base64,$i' width='100px'> <br> <br> ");
            }
        ?>
        </div>
        <div class="resto">
            <div class="texto">
                <h4 name="nome" id="nome"><?php echo($nome) ?></h4>
                <h5 class="preco" name="preco" id="preco">R$<?php echo($preco) ?></h5>
            </div>
            <form action="carrinho.php" method="post" class="addremove">
                <button id="btn_decrementar" name="remover" type="submit" class="remove">-</button>
                <?php
                if(isset($_POST["remover"])){
                        $comando = $pdo->prepare("UPDATE produtos SET quantidade=(quantidade-1) WHERE nome = :nome)");
                        $comando->bindParam(":nome", $nome);
                        $resultado = $comando->execute();
                    }
                ?>               
                <p name="number" class="number" id="contador"></p>
                <button id="btn_incrementar" name="adicionar" type="submit" class="add">+</button>  
                <?php
                if(isset($_POST["adicionar"]))
                    {
                        $comando = $pdo->prepare("UPDATE produtos SET quantidade=(quantidade+1) WHERE nome = :nome");
                        $comando->bindParam(":nome", $nome);
                        $resultado = $comando->execute();
                    }
                ?>
            </form>
        </div>
    </div>

    
     
     <!--BOTÃO FINALIZE SEU PEDIDO-->
    <form action="carrinho.php" class="alinhaBotao" method="post">
        <button name="finalizar" type="submit">Finalize seu pedido</button>
        <?php
        if(isset($_POST["finalizar"]))
            {
                $comando = $pdo->prepare("UPDATE produtos SET carrinho = 0 WHERE nome = :nome");
                $comando->bindParam(":nome", $nome);
                $resultado = $comando->execute();
            }
        ?>
    </form>
</body>
<script>
    
contador = <?php echo($quantidade) ?>;

if (contador <= 0)
    {
        if (window.confirm("Deseja remover o item do carrinho?"))
        {
            prot.style.display = "none";
        }
    }
var carrinho = <?php echo($carrinho)?>

if(carrinho <= 0)
{
    prot.style.display = "none";
}
else
{
    prot.style.display = "flex";
}

</script>
</html>


<!-- AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS AMO PIROCAS GROSAS  -->