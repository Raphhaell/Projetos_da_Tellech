<?php
session_start();

if (isset($_POST['produto_id']) && isset($_POST['quantidade'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Verifique se o carrinho existe na sessão e, se não existir, crie-o.
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    // Verifique se o produto já está no carrinho.
    $produto_no_carrinho = false;
    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['produto_id'] == $produto_id) {
            // O produto já está no carrinho, você pode atualizar a quantidade aqui.
            $item['quantidade'] += $quantidade;
            $produto_no_carrinho = true;
            break;
        }
    }

    if (!$produto_no_carrinho) {
        // O produto não está no carrinho, então adicione-o com a quantidade especificada.
        $_SESSION['carrinho'][] = array(
            'produto_id' => $produto_id,
            'quantidade' => $quantidade
        );
    }
}


// Redirecione de volta para a página de produtos após a adição.
header('Location: carrinho.php');

?>