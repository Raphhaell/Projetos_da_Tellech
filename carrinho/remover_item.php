<?php
session_start();

//Verificar se o ID do produto a ser excluído foi enviado via POST
if(isset($_POST['del'])) {
    //Obter o ID do produto a ser excluído
    $id = intval($_POST['del']);

    //Verificar se o carrinho está na sessão
    if (isset($_SESSION['carrinho'])) {
        $carrinho = &$_SESSION['carrinho']; //Com o &, qualquer mudança que eu fizer em $carrinho vai diretamente para a sessão também

        foreach ($carrinho as $index => $item) {
            $produto_id = intval($item['produto_id']);
            if ($produto_id === $id) {
                //Remover o produto do carrinho
                unset($carrinho[$index]);
                break; //Parar a iteração após encontrar a correspondência
            }
        }
    } else {
        echo "O carrinho não está na sessão";
    }
} else {
    echo "O ID do produto a ser excluído não foi enviado via POST";
}

header('Location: carrinho.php');

?>