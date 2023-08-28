<?php
include('../cod_conexao.php');

//se existir email e senha, vai fazer o processo de login
if (isset($_POST['email']) || isset($_POST['senha'])) {

    //se a quantidade de caracteres do email for igual a 0, mostra a mensagem
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) { //se a qtd de caracteres da senha for igual a 0
        echo "Preencha sua senha";
    } else {
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        //faz a consulta. Se der errado, vai mostrar o erro (die)
        $sql_code = "SELECT * FROM Cliente WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);
        
        //se existir o usuário e a senha, vai retornar 1 registro

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            //vai pegar os dados do banco de dados e jogar na variável
            $usuario = $sql_query->fetch_assoc();

            //se não existir a sessão, vai criar uma
            if (!isset($_SESSION)) {
                session_start();
            }

            //vai jogar na sessão o id e nome do usuário
            $_SESSION['id'] = $usuario['Id'];
            $_SESSION['nome'] = $usuario['Nome'];

            header("Location: painel.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos.";
        }
    }
}

?>