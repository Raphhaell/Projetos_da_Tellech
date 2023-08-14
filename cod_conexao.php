<?php
  
  $conexao = mysqli_connect('localhost', 'root', 'usbw', 'tellech');
  
  if(!$conexao){
    die('Erro de conexão (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
  }

  echo "Sucesso..." . mysqli_get_host_info($conexao) . "<br>";
  
  //mysqli_close($con);

?>