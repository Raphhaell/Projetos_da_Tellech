<?php
include_once("./cod_conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rede Social Tellech</title>

    <link rel="stylesheet" href="forum.css">
</head>
<body>
    <header>
        <a href="../index.php"><img src="imagens/LogoTellechSemFundo.png" alt="logo" width="75px"></a>
    </header>

    <main class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="imgUser"></div>
                <strong>Nome do Usuário</strong>
            </div>

            <!-- Formulário para fazer post-->
            <form action="./publicar.php" class="formPost" method="POST" enctype="multipart/form-data">
                <input type="text" name="titulopost" id="titulopost" placeholder="Escreva o título da sua postagem">
                <input type="textarea" name="textarea" placeholder="Abra sua Mente!">
                <div class="iconsAndButton">
                    <div class="icons">
                        <label for="image" class="btn"><img src="icones/img.svg" alt="Adicionar uma Imagem"></label>
                        <input type="file" name="imagem" id="image" accept="image/*" style="display: none;" />
                        <div id="file-name"></div>
                    <!-- <button class="btn"><img src="icones/video.svg" alt="Adicionar um vídeo"></button> -->
                    </div>

                    <button type="submit" class="btnSubmitForm">Publicar</button>
                </div>
            </form><!-- Fecha Formulário para fazer post-->
        </div><!-- Fecha Div New Post-->

        <!-- Postagens -->
        <ul class="posts">
            <?php

            $comando = "SELECT * FROM postagem";
            $enviar = mysqli_query($conexao, $comando);
            $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);

            foreach ($resultado as $postagem){
                $id = $postagem['Id'];
                $tituloPostagem = $postagem['TituloPostagem'];
                $conteudoPublicacao = $postagem['ConteudoPublicacao'];
                $dataPublicacao = $postagem['DataPublicacao'];
                $dataDaPublicacao = implode("/",array_reverse(explode("-",$dataPublicacao)));
                $imagemData = $postagem['MidiaPostagem'];
                $curtida = $postagem['Curtidas'];
                $Id = $postagem['IdPublicacao'];
               // $comentario = $postagem['ConteudoComentario']

               $sql = "SELECT nome FROM cliente WHERE Id = '$id'";
               $query = mysqli_query($conexao, $sql);

               // Verifique se a consulta foi bem-sucedida
                if ($query) {
                    // Use a função mysqli_fetch_assoc para obter a linha de resultados como um array associativo
                    $row = mysqli_fetch_assoc($query);

                    if ($row) {
                        // O nome do cliente está no array associativo com a chave "nome"
                        $nome = $row['nome'];
                    } else {
                        // Não foi encontrado nenhum registro com o ID fornecido
                        echo "Cliente não encontrado.";
                    }
                } else {
                    // Se a consulta falhar, você pode lidar com o erro aqui
                    echo "Erro na consulta: " . mysqli_error($conexao);
                }

                ?>
                
            <!-- Postagem 1 -->
            <li class="post">
                <div class="infoUserPost">
                    <div class="imgUserPost"></div>
                    <div class="nameAndHour">
                        <strong><?=utf8_encode($nome)?></strong>
                        <p><?=utf8_encode($dataDaPublicacao)?></p>
                    </div>
                    <!-- Lida com a exclusão do Post  -->
                    <form action="excluir.php" method="POST">
                        <input type="hidden" name="id_publicacao" value="<?= $postagem['IdPublicacao'] ?>">
                        <button type="submit" class="filesPost delete">
                            <img src="icones/menu.svg" alt="Excluir" width="25px"> Excluir Post
                        </button>
                    </form>
                </div>

                <p><?=utf8_encode($tituloPostagem)?></p>
                <p><?=utf8_encode($conteudoPublicacao)?></p>

                <!-- Display the image -->
                <?php if (!empty($imagemData)) { ?>
                <img class="ImagePost" src="data:image/jpeg;base64,<?= base64_encode($imagemData) ?>" alt="Post Image">
                <?php } ?> 

                <div class="actionBtnPost">
                    <button type="button" class="filesPost like"><img src="icones/heart.svg" alt="Curtir">Curtir</button>
                    <button type="button" class="filesPost comment commentButton"><img src="icones/comment.svg" alt="Comentar">Comentar</button>
                <!--<button type="button" class="filesPost share"><img src="icones/share.svg" alt="Compartilhar">Compartilhar</button> -->
                    <p><span class="likeCount"><?=utf8_encode($curtida)?></span> Curtidas</p>
                </div>

               

                <!-- Área para comentários -->
                <form action="./comentario.php" class="formPost" method="POST">
                <div class="commentArea">
                    <input type="text" name="comentario" placeholder="Escreva seu comentário">
                    <button type="submit" class="btnSubmitForm">Publicar</button>
                </div>
                </form>
                
            </li>

            <?php
            }
            ?>
        </ul>
    </main>
    <script src="java.js"></script>
</body>
</html>
