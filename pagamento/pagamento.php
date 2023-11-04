<?php
include_once('../cod_conexao.php');
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pagamento.css"> <!-- Arquivo CSS personalizado -->
</head>
<body>
<header> <!--imagem logo -->
	<a href="../carrinho/carrinho.php" class="logo"><img src="../logo_Tellech.png" alt="logo" ></a>
</header> <!--Fim Header -->
    <div class="container">
    <?php
            $comando = "SELECT * FROM cliente WHERE Id = {$_SESSION['id']}";
            $enviar = mysqli_query($conexao, $comando);
            $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);

            foreach ($resultado as $usuario){
                $nome = $usuario['Nome'];
                $dataNascimento = $usuario['DataDeNascimento'];
                $cpf = $usuario['CPF'];
                $email = $usuario['Email'];
                $numero = $usuario['Numero'];
                $complemento = $usuario['Complemento'];
                $cep = $usuario['CEP'];
                $telefone1 = $usuario['Telefone_1'];

                $dataDeNascimento = implode("/",array_reverse(explode("-",$dataNascimento)));


        ?>

        <form action="finalizar_pagamento.php" method="post">
            <div class="row">
                <div class="col">
                    <h3 class="title">Pagamento</h3>
                    <div class="inputBox">
                        <span>Nome completo</span>
                        <input type="text" value="<?=utf8_encode($nome)?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>Email</span>
                        <input type="email" value="<?=utf8_encode($email)?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>CEP</span>
                        <input type="text" value="<?=utf8_encode($cep)?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>Complemento</span>
                        <input type="text" value="<?=utf8_encode($complemento)?>" readonly>
                    </div>
                    <div class="flex"></div>
                </div>
                <div class="col">
                    <h3 class="title-branco"></h3>
                    <div class="inputBox">
                        <span>Data de Nascimento</span>
                        <input type="text" value="<?=utf8_encode($dataDeNascimento)?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>CPF</span>
                        <input type="text" value="<?=utf8_encode($cpf)?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>Numero</span>
                        <input type="text" value="<?=utf8_encode($numero)?>" readonly>
                    </div>
                    <div class="inputBox">
                        <span>Celular</span>
                        <input type="text" value="<?=utf8_encode($telefone1)?>" readonly>
                    </div>
                </div>
                <div class="col">
                    <h3 class="title">Forma de Pagamento</h3>
                    <div class="inputBox">
                        <span>Cartões Aceitos:</span>
                        <img src="https://i0.wp.com/canalreidoscartoes.com/wp-content/uploads/2022/05/Qual-a-diferenca-entre-as-bandeiras-de-cartao-de-credito.jpg?fit=800%2C534&ssl=1" alt="">
                    </div>
                    <div class="inputBox">
                        <span>Escolha o método de pagamento:</span>
                        <select name="metodo_pagamento" id="metodo_pagamento">
                            <option value="" selected disabled>Veja as opções</option>
                            <option value="pix">Pix</option>
                            <option value="boleto">Boleto</option>
                            <option value="debito">Débito</option>
                            <option value="credito">Crédito</option>
                        </select>
                    </div>
                    <button id="prosseguirBtn" class="submit-btn">Prosseguir pagamento</button>
                </div>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
    <script src="script.js"></script> <!-- Adicione o arquivo JavaScript -->
</body>
</html>