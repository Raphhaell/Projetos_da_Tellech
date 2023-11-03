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

        <!--Máscara do Jquery-->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
        <script src="mascara.js"></script>
    </head>

    <body>
        <header> <!--imagem logo -->
            <a href="../index.php" class="logo"><img src="../logo_Tellech.png" alt="logo" ></a>
        </header> <!--Fim Header -->

        <?php
            $comando = "SELECT * FROM cliente WHERE Id = {$_SESSION['id']}";
            $enviar = mysqli_query($conexao, $comando);
            $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);

            foreach ($resultado as $usuario){
                $nome = $usuario['Nome'];
                $dataNascimento = $usuario['DataDeNascimento'];
                $cpf = $usuario['CPF'];
                $genero = $usuario['Genero'];
                $email = $usuario['Email'];
                $senha = $usuario['Senha'];
                $logradouro = $usuario['Logradouro'];
                $numero = $usuario['Numero'];
                $complemento = $usuario['Complemento'];
                $cep = $usuario['CEP'];
                $bairro = $usuario['Bairro'];
                $cidade = $usuario['Cidade'];
                $estado = $usuario['Estado'];
                $telefone1 = $usuario['Telefone_1'];
                $telefone2 = $usuario['Telefone_2'];

                $dataDeNascimento = implode("/",array_reverse(explode("-",$dataNascimento)));

                if(isset($usuario['foto'])){
                    $midia = $usuario['Foto'];
                    $imagem = imagecreatefromstring($midia);
                    ob_start();
                    imagejpeg($imagem, null, 80);
                    $data = ob_get_contents();
                    ob_end_clean();
                } else{
                    $midia = NULL;
                    $data = NULL;
                }
        ?>

        <!--SOMENTE MOSTRA OS DADOS-->
        <section class="seccion-perfil-usuario" id="perfil-usuario-bio-dados">
            <div class="perfil-usuario-header" >
                <div class="perfil-usuario-portada">
                    <div class="perfil-usuario-avatar">
                        <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" alt=\"Imagem Usuário\"/>";?>
                        <button type="button" class="boton-avatar"><i class="far fa-image"></i></button>
                    </div>
                </div>
            </div><!--Perfil-usuario-header-->

            <div class="perfil-usuario-body">
                <div class="perfil-usuario-bio">
                    <h3 class="titulo"><?=utf8_encode($nome)?></h3>
                </div> <!--Perfil-usuario-bio-->

                <div class="perfil-usuario-footer">
                    <ul class="lista-datos">
                        <li> <strong>Data de Nascimento:</strong> <?=$dataDeNascimento?></li>
                        <li> <strong>E-mail:</strong> <?=$email?></li>
                        <li> <strong>Senha:</strong> <?=$senha?></li>
                        <li> <strong>CPF:</strong> <?=$cpf?></li>
                        <li> <strong>Logradouro:</strong> <?=utf8_encode($logradouro)?></li>
                        <li> <strong>Número:</strong> <?=$numero?></li>
                        <li> <strong>Complemento:</strong> <?=utf8_encode($complemento)?></li>
                    </ul>
                    <ul class="lista-datos">
                        <li> <strong>Bairro:</strong> <?=utf8_encode($bairro)?></li>
                        <li> <strong>Cidade:</strong> <?=utf8_encode($cidade)?></li>
                        <li> <strong>Estado:</strong> <?=utf8_encode($estado)?></li>
                        <li> <strong>CEP:</strong> <?=$cep?></li>
                        <li> <strong>Gênero:</strong> <?=utf8_encode($genero)?></li>
                        <li> <strong>Celular:</strong> <?=$telefone1?></li>
                        <li> <strong>Telefone Fixo:</strong> <?=$telefone2?></li>
                    </ul>

                    <button type="submit" onclick="displayHide()" name="editar" class="botao-editar"><i class="fa-regular fa-pen-to-square"></i></button>

                    <div class="espaco-em-branco"></div>
                </div><!--Perfil-usuario-footer-->
            </div><!--Perfil-usuario-body-->
        </section>
        <!--SOMENTE MOSTRA OS DADOS-->



        <!--EDITAR OS DADOS-->
        <section class="seccion-perfil-usuario-editar" id="perfil-usuario-bio-editar">
            <div class="perfil-usuario-header">
                <div class="perfil-usuario-portada">
                    <div class="perfil-usuario-avatar">
                        <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" alt=\"Imagem Usuário\"/>";?>
                        <button type="button" class="boton-avatar"><i class="far fa-image"></i></button>
                    </div>
                </div>
            </div><!--Perfil-usuario-header-->

            <div class="perfil-usuario-body">
                <form class="formulario-perfil" action="atualizar_dados.php" method="post">
                    <div class="perfil-usuario-bio">
                        <div class="input-box">
                            <input class="titulo" type="text" name="nome" value="<?=utf8_encode($nome)?>">
                        </div>
                    </div> <!--Perfil-usuario-bio-->

                    <div class="perfil-usuario-footer">
                        <div class="input-group">
                            <div class="input-box">
                                <label><strong>Data de Nascimento</strong></label>
                                <input type="text" id="datadenascimento" name="datadenascimento" value="<?=utf8_encode($dataDeNascimento)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>E-mail</strong></label>
                                <input type="email" name="email" value="<?=utf8_encode($email)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Senha</strong></label>
                                <input type="password" name="senha" value="<?=utf8_encode($senha)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>CPF</strong></label>
                                <input type="text" id="cpf" name="cpf" value="<?=utf8_encode($cpf)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Logradouro</strong></label>
                                <input type="text" name="logradouro" value="<?=utf8_encode($logradouro)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Número</strong></label>
                                <input type="text" name="numero" value="<?=utf8_encode($numero)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Complemento</strong></label>
                                <input type="text" name="complemento" value="<?=utf8_encode($complemento)?>">
                            </div>

                            <div class="input-box">
                                <label><strong>Bairro</strong></label>
                                <input type="text" name="bairro" value="<?=utf8_encode($bairro)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Cidade</strong></label>
                                <input type="text" name="cidade" value="<?=utf8_encode($cidade)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Estado</strong></label>
                                <input type="text" name="estado" value="<?=utf8_encode($estado)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>CEP</strong></label>
                                <input type="text" id="cep" name="cep" value="<?=utf8_encode($cep)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Gênero</strong></label>
                                <input type="text" name="genero" value="<?=utf8_encode($genero)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Celular</strong></label>
                                <input type="tel" id="celu" name="celu" value="<?=utf8_encode($telefone1)?>" required>
                            </div>

                            <div class="input-box">
                                <label><strong>Telefone Fixo</strong></label>
                                <input type="text" id="telefone1" name="telefone1" value="<?=utf8_encode($telefone2)?>">
                            </div>
                            
                            <div class="salvar-button">
                                <button type="submit" onclick="displayShow()" class="btn-salvar" name="salvar">Salvar</button>
                            </div>
                        </div><!--INPUT GROUP-->
                        
                        
                        
                    </div><!--Perfil-usuario-footer-->
                </form>
            </div><!--Perfil-usuario-body-->
        </section>
            <!--EDITAR OS DADOS-->
                    
        <?php
            }
        ?>

            <script>
                var elementoOcultar = document.getElementById("perfil-usuario-bio-editar");
                var elementoMostrar = document.getElementById("perfil-usuario-bio-dados");
                console.log(elementoOcultar);
                console.log(elementoMostrar);

                function displayHide() {
                    if (elementoOcultar && elementoMostrar) {
                        elementoOcultar.style.display = "flex";
                        elementoMostrar.style.display = "none";
                    }
                }

                function displayShow() {
                    if (elementoOcultar && elementoMostrar) {
                        elementoOcultar.style.display = "none";
                        elementoMostrar.style.display = "block";
                    }
                }
            </script>
    </body>
</html>