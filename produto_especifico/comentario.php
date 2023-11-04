<?php
include_once('./cod_conexao.php');

$comentario = $_POST['comentario'];
$idPublicacao = $_POST['idPublicacao'];

// Use declarações preparadas para evitar injeção de SQL
$sql = "UPDATE avaliacao SET Comentario = '$comentario' WHERE IdPublicacao = $idPublicacao";
    
// Prepare a declaração SQL
$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {
    // Associe os parâmetros e execute a declaração
    mysqli_stmt_bind_param($stmt, 'si', $comentario, $idPublicacao);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Comentário atualizado com sucesso.";
    } else {
        echo "Erro na atualização do comentário: " . mysqli_error($conexao);
    }

}

// Redireciona para a página de produtos
header("Location: produto.php");

?>