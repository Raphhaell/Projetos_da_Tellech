<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $dataNascimento = $_POST['datadenascimento'];
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

    $sql = "INSERT INTO Cliente (Nome, DataDeNascimento, CPF, Genero, Email, Senha, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, CEP, Telefone_1, Telefone_2) values('$nome', '$dataNascimento', '$cpf', '$genero', '$email', '$senha', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$telefone1', '$celular')";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado === FALSE)
        echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        mysqli_close($conexao);

    header("Location: ../index.html");
?>