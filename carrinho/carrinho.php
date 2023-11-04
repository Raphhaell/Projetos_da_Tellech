<?php

include_once('../cod_conexao.php');
session_start();

// Inicialize $_SESSION['informacoes_calculo'] como um array vazio se não existir
if (!isset($_SESSION['informacoes_calculo'])) {
  $_SESSION['informacoes_calculo'] = array();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrinho</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link href="carrinho.css" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="carrinho.js" async></script>
  </head>

  <body>

    <?php
        if(isset($_SESSION['id'])){
            include('./menu_logado.php');
        }else{
            include('./menu.html');
        }
    ?>      

    <main>
      <div class="page-title"></div>

        <div class="content">
          
          <section>
            <?php
            if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
              // Existe pelo menos um produto no carrinho, então exiba o carrinho.
            ?>

            <table>
              <thead>
                <tr>
                  <th>Produto</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
                  <th>Total</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                
                <?php
                if (isset($_POST['produto_id'])) {
                  $produtoId = $_POST['produto_id'];
                  // Agora você tem o $produto_id disponível para usar em sua página carrinho.php.
                }

                if (isset($_SESSION['carrinho'])) {
                  $totalGeral = 0;
                  $informacoesCalculo = array();

                  foreach ($_SESSION['carrinho'] as $produto_id) {
                    $idProduto = $produto_id['produto_id'];
                    $quantidade = $produto_id['quantidade'];

                    $comando = "SELECT * FROM produto WHERE IdProduto = $idProduto";
                    $enviar = mysqli_query($conexao, $comando);
                    $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);

                    foreach ($resultado as $produto){
                      $nome = $produto['NomeProduto'];
                      $preco = $produto['Preco'];

                      $midia = $produto['MidiaProduto'];
                      $imagem = imagecreatefromstring($midia);
                      ob_start();
                      imagejpeg($imagem, null, 80);
                      $data = ob_get_contents();
                      ob_end_clean();

                      // Remova a formatação da moeda e converta o preço para um valor numérico
                      $precoNumerico = floatval(str_replace(['R$', '.', ','], ['', '', '.'], $preco));

                      $totalProduto = $precoNumerico * $quantidade;
                      $totalFormatado = "R$ " . number_format($totalProduto, 2, ',', '.'); // Formate o total do produto

                      $totalGeral += $totalProduto;
                      $totalGeralFormatado = "R$ " . number_format($totalGeral, 2, ',', '.');            



                      $informacoesCalculo[$idProduto] = array(
                        'totalFormatado' => $totalFormatado,
                        'totalGeralFormatado' => $totalGeralFormatado
                      );

                      //var_dump($informacoesCalculo);
                      ?>
                      
                      <tr>
                        <td>
                          <div class="product">
                            <?php echo "<img src=\"data:image/jpg;base64," .  base64_encode($data)  . "\" width=150px heigth=150px/>";?>
                
                            <div class="info">
                              <div class="name"><?=utf8_encode($nome)?></div>
                            </div>
                          </div>
                        </td>

                        <td class="preco"><?=utf8_encode($preco)?></td>
                        <td>
                          <div class="qty">
                            <input type="hidden" name="atualizar" value="<?=$idProduto?>">
                            <button class="diminuir-quantidade" data-produto="<?=$idProduto?>" data-preco="<?=$precoNumerico?>"><i class="bx bx-minus"></i></button>
                            <span name="quantidade" class="quantidade"><?=$quantidade?></span>
                            <button class="aumentar-quantidade" data-produto="<?=$idProduto?>" data-preco="<?=$precoNumerico?>"><i class="bx bx-plus"></i></button>
                          </div>
                        </td>

                        <td class="precoTotal" id="precoTotal-<?=$idProduto?>" data-geral="<?=$totalGeral?>"><?=$totalFormatado?></td>

                        <td>
                          <form action="remover_item.php" method="POST">
                            <input type="hidden" name="del" value="<?=$idProduto?>">
                            <button class="remover-item"><i class="bx bx-x"></i></button>
                          </form>
                        </td>
                      </tr>

                    <?php
                    }
                  }

                  $_SESSION['informacoes_calculo'] = $informacoesCalculo;
                  
                }
                ?>
              </tbody>
            </table>
          </section>

          <aside>
            <div class="box">
              <div class="summary-header">Resumo da compra</div>
              <div class="info">
                <div><span>Sub-total: </span><span name="sub-total" id="sub-total"><?=$totalGeralFormatado?></span></div>
                <div class="frete"><span>Frete: </span><span>Indefinido até o momento</span></div>
              </div>
              <footer>
                <span>Total:</span>
                <span name="total" id="total"><?=$totalGeralFormatado?></span>
              </footer>
            </div>
            <form class="btn-comprar" action="finalizar_compra.php" method="post">
              <button type="submit">Finalizar Compra</button>
            </form>
          </aside>
              

            <?php
            } else {
              // Não há produtos no carrinho, exiba uma mensagem.
            ?>

            <h1 style="font-size: 50px; text-align: center;">O carrinho está vazio.</h1>
            <style>
              body{
                background-color: #FFFFFF;
              }
            </style>
          </section>
          <?php
          }
          ?>   
        </div>

    </main>
  </body>
</html>