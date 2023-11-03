<?php
session_start();

$produto_id = $_POST['produto_id'];
$quantidade = $_POST['quantidade'];

// Verifique se o produto já está no carrinho.
foreach ($_SESSION['carrinho'] as &$item) {
    if ($item['produto_id'] == $produto_id) {
        // O produto já está no carrinho, você pode atualizar a quantidade aqui.
        $item['quantidade'] = max(1, $quantidade);
    }
}

?>