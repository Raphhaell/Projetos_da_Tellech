<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $dataAbertura = $_POST['datadeabertura'];
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

    $sql = "INSERT INTO empresa (Nome, DataDeAbertura, CNPJ, Email, Senha, Logradouro, Numero, Complemento, CEP, Bairro, Cidade, Estado, Telefone_1, Telefone_2) values('$nome', '$dataAbertura', '$cnpj', '$email', '$senha', '$logradouro', '$numero', '$complemento', '$cep', '$bairro', '$cidade', '$estado', '$telefone1', '$celular')";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado === FALSE)
        echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
    else
        echo mysqli_affected_rows($conexao) . " registro incluído com sucesso!</br>";

    mysqli_close($conexao);

?>