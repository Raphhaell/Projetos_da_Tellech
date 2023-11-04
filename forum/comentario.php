<?php
include_once('./cod_conexao.php');

    $texto = $_POST['comentario'];

    $sql = "INSERT INTO comentario (ConteudoComentario) values('$texto')";

        mysqli_set_charset($conexao, "utf8");
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado === FALSE){
            echo "Erro na inclusão do registrooo..." . mysqli_error($conexao) . "</br>";
        } else {
            echo "Usuário cadastrado com sucesso.</br>";
        }
            
        mysqli_close($conexao);
        //header("Location: ../index.php");
        
?>