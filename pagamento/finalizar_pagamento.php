<?php
include_once('../cod_conexao.php');
session_start();

$idPedido = $_SESSION['IdPedido'];
$formaDePagamento = $_POST['metodo_pagamento'];

$alterarPedido = "UPDATE pedido set FormaDePagamento = '$formaDePagamento' WHERE IdPedido = $idPedido";

if (mysqli_query($conexao, $alterarPedido)) {
    echo "Foi alterado com sucesso";
} else {
    echo "Erro ao alterar pedido: " . mysqli_error($conexao);
}

// Certifique-se de que a sessão está iniciada
if (isset($_SESSION['carrinho'])) {
    // Destrua a sessão para esvaziar o carrinho
    unset($_SESSION['carrinho']);
}

//header('Location: ../index.php');
header('Location: analise.php?formaPagamento=' . urlencode($formaDePagamento));

?>