<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $dataNascimento = implode("-",array_reverse(explode("/", $_POST['datadenascimento'])));
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $foto = $_FILES['foto']['tmp_name'];
    $tamanho = $_FILES['foto']['size'];
    $tipo = $_FILES['foto']['type'];
    $nomeFoto = $_FILES['foto']['name'];

    if ($foto != "none") {
        $fp = fopen($foto, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);

        $sql = "INSERT INTO administrador (Nome, DataDeNascimento, CPF, Email, Senha, Foto) values('$nome', '$dataNascimento', '$cpf', '$email', '$senha', '$conteudo')";

        mysqli_set_charset($conexao, "utf8");
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado === FALSE){
            echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        } else {
            echo "Usuário cadastrado com sucesso.</br>";
        }
            
        mysqli_close($conexao);
        //header("Location: ../index.php");

    } else {
        echo "Não foi possível carregar a imagem";
    }
?>