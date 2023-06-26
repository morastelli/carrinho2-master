<?php
        // ATENÇÃO: o tipo da coluna na tabela deve ser MEDIUMBLOB
        include("conecta.php");

        $login = $_POST["login"];
        $senha = $_POST["senha"];

        // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
		$imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
		
		$comando = $pdo->prepare("INSERT INTO alunos(login,senha,foto) VALUES(:login,:senha,:foto)");
        $comando->bindParam(":login", $login);
        $comando->bindParam(":senha", $senha);
        $comando->bindParam(":foto", $imagem, PDO::PARAM_LOB);
		$resultado = $comando->execute();



        
        // As linhas abaixo você usará sempre que quiser mostrar a imagem

        $comando = $pdo->prepare("SELECT * FROM alunos WHERE login='$login'");
		$resultado = $comando->execute();
        while( $linhas = $comando->fetch() )
        {
            $dados_imagem = $linhas["foto"];
            $i = base64_encode($dados_imagem);

            $login =  $linhas["login"];
            $senha =  $linhas["senha"];

            echo("LOGIN: $login SENHA: $senha  <br>");
            echo(" <img src='data:image/jpeg;base64,$i' width='100px'> <br> <br> ");
        }
		
?>