<?php
session_start();
include('../protect.php');
include('../cod_conexao.php');

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

$sql = "UPDATE cliente SET Nome = '$nome', DataDeNascimento = '$dataNascimento', CPF = '$cpf', Genero = '$genero', Email = '$email', Senha = '$senha', Logradouro = '$logradouro', Numero = '$numero', Complemento = '$complemento', Bairro = '$bairro', Cidade = '$cidade', Estado = '$estado', CEP = '$cep', Telefone_1 = '$celular', Telefone_2 = '$telefone1' WHERE Id = {$_SESSION['id']}";


mysqli_set_charset($conexao, "utf8");
$resultado = mysqli_query($conexao, $sql);

if ($resultado === FALSE){
    echo "Erro ao atualizar os dados..." . mysqli_error($conexao) . "</br>";
} else {
    echo "Dados atualizados com sucesso.</br>";
}
        
mysqli_close($conexao);
header("Location: ./perfil_do_usuario.php");

?>