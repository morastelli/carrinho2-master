<?php

    include("conecta.php");

    $id_produto = $_POST["id_produto"];
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $preco = $_POST["preco"];

    if(isset ($_POST["inserir"]))
    {
    $comando = $pdo->prepare("INSERT INTO produtos VALUES($id_produto,'$nome',$quantidade,$preco)" );
    $resultado = $comando->execute();
    }

    if(isset ($_POST["excluir"]))
    {
    $comando = $pdo->prepare("DELETE FROM produtos WHERE id_produto=$id_produto" );
    $resultado = $comando->execute();
    }

    if(isset ($_POST["alterar"]))
    {
    $comando = $pdo->prepare("UPDATE produtos SET nome='$nome', quantidade=$quantidade WHERE id_produto=$id_produto" );
    $resultado = $comando->execute();
    }

    if(isset ($_POST["listar"]))
    {
    $comando = $pdo->prepare("SELECT * FROM produtos" );
    $resultado = $comando->execute();
    
   
    while($linhas=$comando->fetch())
    {
        $n = $linhas["nome"];
        $i = $linhas["id_produto"];
        $q = $linhas["quantidade"];
        echo("$m $n $i <br> <br>");
    }
    }   

?>