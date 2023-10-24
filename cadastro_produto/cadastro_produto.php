<?php

include_once("../cod_conexao.php");
$query = mysqli_query($conexao, "SELECT NomeCategoria FROM categoria");

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="cadastro_produto.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <title>Cadastro do Produto</title>

  </head>

  <body>
    <header>
      <a href="../index.php" class="logo"><img src="../logo_Tellech.png" alt="logo"></a>
    </header>

    <div class="container">
      <div class="header">
        <h2>Cadastrar Produto</h2>
      </div>

      <form enctype="multipart/form-data" action="./cadastro_form.php" method="post" class="form">
        <div class="form-control">
          <label for="productname">Nome do Produto</label>
          <input type="text" name="nome" id="productname" placeholder="Digite o nome do produto" required/>
        </div>

        <div class="form-control">
          <label for="description">Descrição do Produto</label>
          <input type="text" name="descricao" id="description" placeholder="Digite a descrição" required/>
        </div>

        <div class="form-control">
          <label for="estoque">Estoque do Produto</label>
          <input type="text" name="estoque" id="estoque" placeholder="Digite a quantidade disponível para vendas" required/>
        </div>

        <div class="form-control">
          <label for="price">Preço (R$)</label>
          <input type="text" name="preco" id="price" placeholder="Digite o preço" oninput="formatPrice(this)" min="0" required/>
        </div>

        <div class="form-control">
          <label for="image">Imagem do Produto</label>
          <input type="file" name="imagem" id="image" accept="image/*" required/>
        </div>

        <div class="form-control">
          <label for="empresa">Id da Empresa Vendedora</label>
          <input type="text" name="empresa" id="empresa" placeholder="Digite o id da empresa" required/>
        </div>

        <div class="form-control">
          <label for="categoria">Categoria do Produto</label>
            
          <select name="categoria">
            <option></option>
            <?php
              while($prod = mysqli_fetch_array($query)){
            ?>

            <option>
              <?php
              echo utf8_encode($prod['NomeCategoria']);
              }
              ?>
            </option>
          </select>
        </div>

        <button type="submit">Cadastrar produto</button>
      </form>
    </div>

    <script src="https://kit.fontawesome.com/f9e19193d6.js" crossorigin="anonymous"></script>

    <script src="cadastro_produto.js"></script>
  </body>
</html>