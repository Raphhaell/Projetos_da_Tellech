<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $estoque = $_POST['estoque'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['imagem']['tmp_name'];
    $tamanho = $_FILES['imagem']['size'];
    $tipo = $_FILES['imagem']['type'];
    $nomeArquivo = $_FILES['imagem']['name'];

    $empresa = $_POST['empresa'];
    $categoria = $_POST['categoria'];

    /*$tamanhoMaximo = 1024 * 1024 * 2; //2MB
    if ($tamanho > $tamanhoMaximo) {
        echo "Seu arquivo possui mais de 2MB. Por favor, insira-o até o limite definido<br>";
        exit();
    }*/

    mysqli_set_charset($conexao, "utf8");
    $query = mysqli_query($conexao, "SELECT IdCategoria FROM categoria WHERE NomeCategoria = '$categoria'");

    if ($query === FALSE) {
        echo "Erro na consulta da categoria: " . mysqli_error($conexao) . "</br>";
    } elseif (mysqli_num_rows($query) == 0) {
        echo "Nenhuma categoria correspondente encontrada.</br>";
    } else {
        $row = mysqli_fetch_assoc($query);
        $idCategoria = $row['IdCategoria'];
    }

    if ( $imagem != "none" ){
        $fp = fopen($imagem, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);

        $sql = "INSERT INTO produto (NomeProduto, Descricao, QntEstoque, Preco, MidiaProduto, IdCategoria, IdEmpresa) values('$nome', '$descricao', '$estoque', '$preco', '$conteudo', '$idCategoria', '$empresa')";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado === FALSE) {
            echo "Erro na inserção do produto: " . mysqli_error($conexao) . "</br>";
        } else {
            echo "Produto inserido com sucesso.</br>";
        }

        mysqli_close($conexao);
        header("Location: ../index.php");

    } else {
        echo "Não foi possível carregar a imagem";
    }
?>