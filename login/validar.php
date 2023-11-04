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
        $sql_cliente = "SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha'";
        $sql_admin = "SELECT * FROM administrador WHERE email = '$email' AND senha = '$senha'";
        $sql_empresa = "SELECT * FROM empresa WHERE email = '$email' AND senha = '$senha'";
        
        $query_cliente = $conexao->query($sql_cliente) or die("Falha na execução do código SQL: " . $conexao->error);
        $query_admin = $conexao->query($sql_admin) or die("Falha na execução do código SQL: " . $conexao->error);
        $query_empresa = $conexao->query($sql_empresa) or die("Falha na execução do código SQL: " . $conexao->error);
        
        //se existir o usuário e a senha, vai retornar 1 registro
        $quantidade_cliente = $query_cliente->num_rows;
        $quantidade_admin = $query_admin->num_rows;
        $quantidade_empresa = $query_empresa->num_rows;

        if ($quantidade_cliente == 1) {
            //vai pegar os dados do banco de dados e jogar na variável
            $usuario = $query_cliente->fetch_assoc();
            iniciarSessao($usuario['Id'], $usuario['Nome'], "cliente");
        } elseif ($quantidade_admin == 1) {
            $usuario = $query_admin->fetch_assoc();
            iniciarSessao($usuario['IdAdministrador'], $usuario['Nome'], "admin");
        } elseif ($quantidade_empresa == 1){
            $usuario = $query_empresa->fetch_assoc();
            iniciarSessao($usuario['IdEmpresa'], $usuario['Nome'], "empresa");
        } else{
            echo "Falha ao logar! E-mail ou senha incorretos.";
        }
    }
}

function iniciarSessao($id, $nome, $tipo){
    //se não existir a sessão, vai criar uma
    if (!isset($_SESSION)) {
        session_start();
    }

    //vai jogar na sessão o id e nome do usuário
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo; //Adiciona o tipo de usuário à sessão

    header("Location: ../index.php");

}

?>