<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $dataNascimento = implode("-",array_reverse(explode("/", $_POST['datadenascimento'])));
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $celular = $_POST['celu'];
    $cpf = $_POST['cpf'];
    $telefone1 = $_POST['telefone1'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    $genero = $_POST['genero'];

    $foto = $_FILES['foto']['tmp_name'];
    $tamanho = $_FILES['foto']['size'];
    $tipo = $_FILES['foto']['type'];
    $nomeFoto = $_FILES['foto']['name'];

    if ($foto != "none") {
        $fp = fopen($foto, "rb");
        $conteudo = fread($fp, $tamanho);
        $conteudo = addslashes($conteudo);
        fclose($fp);

        $sql = "INSERT INTO cliente (Nome, DataDeNascimento, CPF, Genero, Email, Senha, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, CEP, Telefone_1, Telefone_2, Foto) values('$nome', '$dataNascimento', '$cpf', '$genero', '$email', '$senha', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$celular', '$telefone1', '$conteudo')";

        mysqli_set_charset($conexao, "utf8");
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado === FALSE){
            echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        } else {
            echo "Usuário cadastrado com sucesso.</br>";
        }
        
        mysqli_close($conexao);
        header("Location: ../index.php");

    } else {
        echo "Não foi possível carregar a imagem";
    }
?>