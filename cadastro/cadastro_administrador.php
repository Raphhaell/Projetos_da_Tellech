<?php
    include_once ('../cod_conexao.php');

    $nome = $_POST['nome'];
    $dataNascimento = $_POST['datadenascimento'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO Administrador (Nome, DataDeNascimento, CPF, Email, Senha) values('$nome', '$dataNascimento', '$cpf', '$email', '$senha')";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado === FALSE)
        echo "Erro na inclusão do registro..." . mysqli_error($conexao) . "</br>";
        
    mysqli_close($conexao);

    header("Location: ../index.html");
?>