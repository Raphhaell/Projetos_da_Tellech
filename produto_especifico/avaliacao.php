<?php
include_once('./cod_conexao.php');

$titulo = $_POST['tituloavaliacao'];
$texto = $_POST['textarea'];

    // Verifica se uma imagem foi enviada
        if ($_FILES['imagem']['error'] === 0) {
            $imagem_tmp = $_FILES['imagem']['tmp_name'];
    
            // Lê o conteúdo da imagem em bytes
            $imagem_data = file_get_contents($imagem_tmp);
    
            // Escapa a imagem_data para uso em uma consulta SQL (prevenção contra injeção de SQL)
            $imagem_data = mysqli_real_escape_string($conexao, $imagem_data);
        }

        $sql = "INSERT INTO avaliacao (TituloAvaliacao, ConteudoPublicacao, MidiaAvaliacao) VALUES ('$titulo', '$texto', '$imagem_data')";

        mysqli_set_charset($conexao, "utf8");
        $resultado = mysqli_query($conexao, $sql);

        /*
        if ($resultado === FALSE){
            echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        } else {
            echo "Usuário cadastrado com sucesso.</br>";
        }
        */

        mysqli_close($conexao);
        header("Location: produto.php");
    
?>