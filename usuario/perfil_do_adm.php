<?php

session_start();
include('../protect.php');
include('../cod_conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="perfil_do_usuario.css">
    </head>

    <body>
        <header> <!--imagem logo -->
            <a href="../index.php" class="logo"><img src="../logo_Tellech.png" alt="logo" ></a>
        </header> <!--Fim Header -->

        <?php
            $comando = "SELECT * FROM administrador WHERE Id = {$_SESSION['id']}";
            $enviar = mysqli_query($conexao, $comando);
            $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);

            foreach ($resultado as $usuario){
                $nome = $usuario['Nome'];
                $dataNascimento = $usuario['DataDeNascimento'];
                $cpf = $usuario['CPF'];
                $email = $usuario['Email'];
                $senha = $usuario['Senha'];

                $dataDeNascimento = implode("/",array_reverse(explode("-",$dataNascimento)));

                $midia = $usuario['Foto'];
				$imagem = imagecreatefromstring($midia);
				ob_start();
				imagejpeg($imagem, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
        ?>

        <section class="seccion-perfil-usuario">
            <div class="perfil-usuario-header">
                <div class="perfil-usuario-portada">
                    <div class="perfil-usuario-avatar">
                        <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" alt=\"img-avatar\"/>";?>
                        <button type="button" class="boton-avatar">
                            <i class="far fa-image"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="perfil-usuario-body">
                <div class="perfil-usuario-bio">
                    <h3 class="titulo"><?=utf8_encode($nome)?></h3>
                    <p class="texto"> </p>
                </div>

                <div class="perfil-usuario-footer">
                    <ul class="lista-datos">
                        <li> <strong>Data de Nascimento:</strong> <?=$dataDeNascimento?></li>
                        <li> <strong>E-mail:</strong> <?=$email?></li>
                        <li> <strong>Senha:</strong> <?=$senha?></li>
                        <li> <strong>CPF:</strong> <?=$cpf?></li>
                    </ul>
                    <ul class="lista-datos">
                        
                    </ul>

        <?php
        }
        ?>

                    <div>
                        <button type="button" class="botao-editar">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                        <div class="espaco-em-branco"></div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>