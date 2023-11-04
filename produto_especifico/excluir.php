<?php

include_once("./cod_conexao.php");

// Verifique se o ID da publicação a ser excluída foi enviado
if (isset($_POST['id_publicacao'])) {
    $id_publicacao = $_POST['id_publicacao'];
    
    // Consulta SQL para excluir a publicação
    $sql = "DELETE FROM avaliacao WHERE IdPublicacao = $id_publicacao";

    if ($conexao->query($sql) === TRUE) {
        // Redirecione de volta para o fórum após a exclusão
        header("Location: produto.php");
    } else {
        echo "Erro ao excluir a publicação: " . $conexao->error;
    }
} else {
    echo "ID de publicação ausente. A exclusão não pode ser realizada.";
}

?>
