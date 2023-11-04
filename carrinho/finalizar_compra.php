<?php
include_once('../cod_conexao.php');
session_start();

$idCliente = $_SESSION['id'];

$info = $_SESSION['informacoes_calculo'];
var_dump($info);

// Crie um novo array combinando os dados do carrinho com os dados de cálculo
$itensCarrinhoComCalculo = array();
var_dump($itensCarrinhoComCalculo);

$inserirPedido = "INSERT INTO pedido (ValorTotal, FormaDePagamento, Id) VALUES (0, 'A Definir', $idCliente)";
if (mysqli_query($conexao, $inserirPedido)) {
    $idPedido = mysqli_insert_id($conexao); // Obtém o ID do pedido inserido
    $_SESSION['IdPedido'] = $idPedido;
} else {
    echo "Erro ao inserir pedido: " . mysqli_error($conexao);
}


foreach ($_SESSION['carrinho'] as $itemCarrinho) {
    $produtoID = $itemCarrinho['produto_id'];
    var_dump($itemCarrinho);

    if (isset($info[$produtoID])) {
        // Combine as informações do carrinho com os dados de cálculo
        $itemCarrinho['totalFormatado'] = $info[$produtoID]['totalFormatado'];
        $itemCarrinho['totalGeralFormatado'] = $info[$produtoID]['totalGeralFormatado'];
    }

    //$itensCarrinhoComCalculo[] = $itemCarrinho;
    //var_dump($itensCarrinhoComCalculo);

    // Obtém o valor total do carrinho
    $valorTotal = $itemCarrinho['totalGeralFormatado']; // Certifique-se de validar e limpar esse valor
    var_dump($valorTotal);

    // Obtém a forma de pagamento (você precisa adicionar essa informação no seu código)
    $formaDePagamento = "A definir"; // Substitua pelo método real

    // Altera a tabela pedido
    $alterarPedido = "UPDATE pedido set ValorTotal = '$valorTotal', FormaDePagamento = '$formaDePagamento', Id = '$idCliente' WHERE IdPedido = $idPedido";

    if (mysqli_query($conexao, $alterarPedido)) {
        echo "Foi alterado com sucesso";
    } else {
        echo "Erro ao alterar pedido: " . mysqli_error($conexao);
    }

    //Obtém a quantidade do item atual
    $quantidade = $itemCarrinho['quantidade'];

    //Obtém o preço total dos produtos
    $precoTotal = $itemCarrinho['totalFormatado'];
        
    // Insere na tabela detalhedopedido
    $inserirDetalhe = "INSERT INTO detalhedopedido (PrecoTotal, QntProduto, IdPedido, IdProduto) 
                        VALUES ('$precoTotal', $quantidade, $idPedido, $produtoID)";
                    
    if (mysqli_query($conexao, $inserirDetalhe)) {
        // Detalhe do pedido inserido com sucesso
    } else {
        echo "Erro ao inserir detalhe do pedido: " . mysqli_error($conexao);
    }
}

header('Location: ../pagamento/pagamento.php');

?>