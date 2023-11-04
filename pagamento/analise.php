<?php
if (isset($_GET['formaPagamento'])) {
    $formaPagamento = urldecode($_GET['formaPagamento']);
    // Agora, $formaPagamento contém o valor passado da página anterior
} else {
    $formaPagamento = "(Erro ao recuperar a forma de pagamento)";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="analise.css"> <!-- Arquivo CSS personalizado -->
</head>
<body>
    <div class="outer-container">
        <div class="inner-container">
            <p>Obrigado por escolher <span class="chosen-payment-method"><?=$formaPagamento?></span> como sua forma de pagamento.</p>
            <p>Seu pedido está em análise. A empresa irá analisar e aprová-lo em breve.</p>
            <p>Você receberá mais informações através do seu e-mail.</p>
            <a href="../index.php"><button class="btn">Ok</button></a>
        </div>
    </div>
</body>
</html>