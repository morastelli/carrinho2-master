<?php
    include("conecta.php");

        $nome = $_GET["nome"];
        $preco = $_GET["preco"];
        $quantidade = 1;
        $carrinho = 1;
        $imagem = $_GET["imagem"];
        
        $nomefoto = "armacao3";

        $foto = file_get_contents($imagem);

        // $comando = $pdo->prepare("INSERT INTO `produtos` (`nome`, `preco`, `quantidade`,`carrinho`)VALUES(:nome, :preco, :quantidade,:carrinho)");
        // $comando->bindParam(":nome", $nome);
        // $comando->bindParam(":preco", $preco);
        // $comando->bindParam(":quantidade", $quantidade);
        // $comando->bindParam(":carrinho", $carrinho);
        // $resultado = $comando->execute();

        // $imagemUrl = $_GET["imagem"];
        // $nomefoto = "armacao3";

        // $foto = file_get_contents($imagemUrl);

  
        // $comando = $pdo->prepare("INSERT INTO foto (nomefoto, foto) VALUES (:nomefoto, :foto)");
        // $comando->bindParam(":nomefoto", $nomefoto);
        // $comando->bindParam(":foto", $foto);
        // $resultado = $comando->execute();


        // $comando = $pdo->prepare("SELECT * FROM foto WHERE nomefoto = :nomefoto");
        // $comando->bindParam(":nomefoto", $nomefoto);
        // $resultado = $comando->execute();

        //$comando = $pdo->prepare("INSERT INTO `produtos` (`nome`, `preco`, `quantidade`,`carrinho`,`foto`)VALUES(:nome, :preco, :quantidade,:carrinho, :foto)");
        //$comando->bindParam(":nome", $nome);
        //$comando->bindParam(":preco", $preco);
        //$comando->bindParam(":quantidade", $quantidade);
        //$comando->bindParam(":carrinho", $carrinho);
        //$comando->bindParam(":foto",$foto);
        //$resultado = $comando->execute();

        $comando = $pdo->prepare("SELECT * FROM produtos WHERE nome = :nome");
        $comando->bindParam(":nome", $nome);
        $resultado = $comando->execute();

        while ($linhas = $comando->fetch()) 
        {
            $dados_imagem = $linhas["foto"];
            $i = base64_encode($dados_imagem);
            echo("<img src='data:image/jpeg;base64,$i' width='100px'>");  
        }
        ?>