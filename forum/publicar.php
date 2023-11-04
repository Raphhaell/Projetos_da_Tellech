<?php
include_once('./cod_conexao.php');
session_start();

$idCliente = $_SESSION['id'];

$titulo = $_POST['titulopost'];
$texto = $_POST['textarea'];

    // Verifica se uma imagem foi enviada
        if ($_FILES['imagem']['error'] === 0) {
            $imagem_tmp = $_FILES['imagem']['tmp_name'];
    
            // Lê o conteúdo da imagem em bytes
            $imagem_data = file_get_contents($imagem_tmp);
    
            // Escapa a imagem_data para uso em uma consulta SQL (prevenção contra injeção de SQL)
            $imagem_data = mysqli_real_escape_string($conexao, $imagem_data);
        }

        $sql = "INSERT INTO postagem (TituloPostagem, ConteudoPublicacao, MidiaPostagem, Id) VALUES ('$titulo', '$texto', '$imagem_data', '$idCliente')";

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
        header("Location: forum.php");


/*
$titulo = $_POST['titulopost'];
$texto = $_POST['textarea'];

// Inicialize um array para armazenar os dados das imagens
$imagens_data = array();

// Verifica se imagens foram enviadas
if (!empty($_FILES['imagens']['name'][0])) {
    $imagens = $_FILES['imagens'];

    foreach ($imagens['tmp_name'] as $key => $imagem_tmp) {
        $imagem_name = $imagens['name'][$key];
        $imagem_data = file_get_contents($imagem_tmp);
        $imagem_data = mysqli_real_escape_string($conexao, $imagem_data);
        $imagens_data[] = $imagem_data;
    }
}

// Insira os dados das imagens no banco de dados
if (!empty($imagens_data)) {
    foreach ($imagens_data as $imagem_data) {
        $sql = "INSERT INTO postagem (TituloPostagem, ConteudoPublicacao, MidiaPostagem) VALUES ('$titulo', '$texto', '$imagem_data')";
        mysqli_set_charset($conexao, "utf8");
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado === FALSE) {
            echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        } else {
            echo "Usuário cadastrado com sucesso.</br>";
        }
    }
}
*/
    
?>