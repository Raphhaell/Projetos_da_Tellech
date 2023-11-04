<?php
include_once("./cod_conexao.php");
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estiloproduto.css">
    <link rel="stylesheet" href="forum.css">
    <title>Tellech</title>
</head>
<body>

<?php
    if(isset($_SESSION['id'])){
        include('./menu_logado.php');
    }else{
        include('./menu.html');
    }

    if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];

    // Consulta para buscar os detalhes do produto com base no ID
    $comando = "SELECT * FROM produto WHERE IdProduto = $produto_id";
    $enviar = mysqli_query($conexao, $comando);
    $produto = mysqli_fetch_assoc($enviar);

    if ($produto) {
        // Aqui você pode exibir os detalhes do produto
        $nome = $produto['NomeProduto'];
        $descricao = $produto['Descricao'];
        $preco = $produto['Preco'];

        if(isset($produto['MidiaProduto'])){
            $midia = $produto['MidiaProduto'];
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



<section class="home">
    <div class="home-img">
    <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" alt=\"One\"/>";?>
    </div>
    <div class="home-text">
        <h1><?=utf8_encode($nome)?></h1>
        <h5><?=utf8_encode($descricao)?></h5>
        <h3><?=utf8_encode($preco)?></h3>

        <form class="carrinho" method="POST" action="../carrinho/gerenciar_carrinho.php">
            <input type="hidden" name="produto_id" value="<?=$produto_id?>">
            <input type="hidden" name="quantidade" value="1">
            <button class="btnCarrinho" type="submit">Adicionar ao carrinho</button>
        </form>
    </div>
</section>

<?php
    }
}

$produto_id = $produto_id;
?>


<h1 style="text-align: center;">Avaliações:</h1>
   
        <main class="main">
            <div class="newPost">
                <div class="infoUser">
                    <div class="imgUser"></div>
                    <strong><?=$_SESSION['nome']?></strong>
                </div>
    
                <!-- Formulário para fazer post-->
                <form action="avaliacao.php" class="formPost" method="POST" enctype="multipart/form-data">
                    <input type="text" name="tituloavaliacao" id="titulopost" placeholder="Escreva o título da sua postagem">
                    <input type="textarea" name="textarea" placeholder="Abra sua Mente!">
                    <div class="iconsAndButton">
                        <div class="icons">
                            <label for="image" class="btn"><img src="icones/img.svg" alt="Adicionar uma Imagem"></label>
                            <input type="file" name="imagem" id="image" accept="image/*" style="display: none;" />
                            <div id="file-name"></div>
                        <!-- <button class="btn"><img src="icones/video.svg" alt="Adicionar um vídeo"></button> -->
                        </div>
    
                        <input type="hidden" name="produto_id" value="<?= $produto_id ?>">
                        <button type="submit" class="btnSubmitForm">Publicar</button>
                    </div>
                </form><!-- Fecha Formulário para fazer post-->
            </div><!-- Fecha Div New Post-->
    
            <!-- Postagens -->
            <ul class="posts">
                <?php
    
                $comando = "SELECT * FROM avaliacao";
                $enviar = mysqli_query($conexao, $comando);
                $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);
    
                foreach ($resultado as $avaliacao){
                $tituloAvaliacao = $avaliacao['TituloAvaliacao'];
                $conteudoAvaliacao = $avaliacao['ConteudoPublicacao'];
                $dataPublicacao = $avaliacao['DataPublicacao'];
                date_default_timezone_set('America/Sao_Paulo'); // Substitua 'America/Sao_Paulo' pelo fuso horário correto
                $dataDaPublicacao = date('d/m/Y H:i:s', strtotime($dataPublicacao));
                $imagemData = $avaliacao['MidiaAvaliacao'];
                $comentario = $avaliacao['Comentario'];
                $Id = $avaliacao['IdPublicacao'];
                $idCliente = $avaliacao['Id'];

                $sql = "SELECT nome FROM cliente WHERE Id = '$idCliente'";
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
                            <input type="hidden" name="id_publicacao" value="<?= $avaliacao['IdPublicacao'] ?>">
                            <button type="submit" class="filesPost delete" alt="Excluir" width="25px"> Excluir Post
                            </button>
                        </form>
                    </div>
    
                    <p><?=utf8_encode($tituloAvaliacao)?></p>
                    <p><?=utf8_encode($conteudoAvaliacao)?></p>
    
                    <!-- Display the image -->
                    <?php if (!empty($imagemData)) { ?>
                    <img class="ImagePost" src="data:image/jpeg;base64,<?= base64_encode($imagemData) ?>" alt="Post Image">
                    <?php } ?> 
    
                    <div class="actionBtnPost">
                    <!--<button type="button" class="filesPost like"><img src="icones/heart.svg" alt="Curtir">Curtir</button> -->
                        <button type="button" class="filesPost comment commentButton"><img src="icones/comment.svg" alt="Comentar">Comentar</button>
                    <!--<button type="button" class="filesPost share"><img src="icones/share.svg" alt="Compartilhar">Compartilhar</button> -->
                    </div>
    
                    <!-- Área para comentários -->
                    <form action="comentario.php" class="formPost" method="POST">
                    <div class="commentArea">
                        <input type="text" name="comentario" placeholder="Escreva seu comentário">
                        <input type="hidden" name="idPublicacao" value="<?= $avaliacao['IdPublicacao'] ?>">
                        <button type="submit" class="btnSubmitForm">Publicar</button>
                    </div>
                    </form>

                    <p><?=utf8_encode($comentario)?></p>
                    
                </li>
    
                <?php
                }
                ?>
            </ul>
        </main>
        <script src="javascript.js"></script>
</body>
</html>