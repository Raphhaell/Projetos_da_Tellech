<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $dataAbertura = implode("-",array_reverse(explode("/", $_POST['datadeabertura'])));
    $cnpj = $_POST['cnpj'];
    $celular = $_POST['celu'];
    $telefone1 = $_POST['telefone1'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
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

        $sql = "INSERT INTO empresa (Nome, DataDeAbertura, CNPJ, Email, Senha, Logradouro, Numero, Complemento, CEP, Bairro, Cidade, Estado, Telefone_1, Telefone_2, Foto) values('$nome', '$dataAbertura', '$cnpj', '$email', '$senha', '$logradouro', '$numero', '$complemento', '$cep', '$bairro', '$cidade', '$estado', '$celular', '$telefone1', '$conteudo')";

        mysqli_set_charset($conexao, "utf8");
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado === FALSE){
            echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        } else{
            echo "Usuário cadastrado com sucesso.</br>";
        }
        
        mysqli_close($conexao);
        header("Location: ../index.php");

    } else {
        echo "Não foi possível carregar a imagem";
    }
    
?>