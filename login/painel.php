<?php

include('../protect.php');

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="Western (ISO 8859-1)">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="protect.css">
        <title>Painel</title>
    </head>

    <body>
        Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.

        <p>
            <a href="../index.php">Index</a>
            <a href="logout.php">Sair</a>
        </p>
    </body>
</html>