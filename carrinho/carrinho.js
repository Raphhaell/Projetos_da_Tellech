$(document).ready(function() {
  //Aumentar a quantidade do carrinho
  $(".aumentar-quantidade").click(function() {
    var produto_id = $(this).data("produto"); //Pega o id do produto
    var quantidadeElement = $(this).siblings(".quantidade"); // Referência ao elemento que exibe a quantidade
    var quantidade = parseInt(quantidadeElement.text()); //Pega o valor da quantidade
    var preco = parseFloat($(this).data("preco")); // Recupere o preço do botão de aumento do produto clicado

    var novoTotal = preco * (quantidade + 1); // Calcule o novo total
    var novoTotalFormatado = novoTotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }); // Formate o novoTotal como uma moeda (R$)

    // Envie uma solicitação AJAX para atualizar a quantidade no servidor.
    $.ajax({
      type: "POST",
      url: "atualizar_quantidade.php",
      data: {
        produto_id: produto_id,
        quantidade: quantidade + 1
      },

      success: function(response) {
        // Atualize a quantidade e o total exibido na página.
        quantidadeElement.text(quantidade + 1);
        $("#precoTotal-" + produto_id).text(novoTotalFormatado);

          var subtotal = 0; // Inicialize o subtotal
          $(".precoTotal").each(function() {  
              var precoTotalText = $(this).text().replace("R$", "").replace(",", ".");
              var precoTotal = parseFloat(precoTotalText);
              subtotal += precoTotal;
          });

        $("#sub-total").text("R$ " + subtotal.toFixed(2).replace(".", ","));
        $("#total").text("R$ " + subtotal.toFixed(2).replace(".", ","));
      },

      error: function(xhr, status, error) {
          console.log("Erro na solicitação AJAX: " + error);
      }
    });
  });
  
  //Diminuir a quantidade do carrinho
  $(".diminuir-quantidade").click(function() {
      var produto_id = $(this).data("produto"); //Pega o id do produto
      var quantidadeElement = $(this).siblings(".quantidade"); // Referência ao elemento que exibe a quantidade
      var quantidade = parseInt(quantidadeElement.text()); //Pega o valor da quantidade
      var preco = parseFloat($(this).data("preco")); // Recupere o preço do botão de aumento do produto clicado

      var novoTotal = preco * (quantidade - 1); //Calcule o novo total
      var novoTotalFormatado = novoTotal.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL' }); //Formate o novoTotal como uma moeda (R$)
  
      if (quantidade > 1) {
          // Envie uma solicitação AJAX para atualizar a quantidade no servidor.
          $.ajax({
          type: "POST",
          url: "atualizar_quantidade.php",
          data: {
              produto_id: produto_id,
              quantidade: quantidade - 1
          },

          success: function(response) {
              // Atualize a quantidade e o total exibido na página.
              quantidadeElement.text(quantidade - 1);
              $("#precoTotal-" + produto_id).text(novoTotalFormatado);

              var subtotal = 0; //Inicialize o subtotal
              $(".precoTotal").each(function() {
                  var precoTotalText = $(this).text().replace("R$", "").replace(",", ".");
                  var precoTotal = parseFloat(precoTotalText);
                  subtotal+=precoTotal;                    
              });

              $("#sub-total").text("R$ " + subtotal.toFixed(2).replace(".", ","));
              $("#total").text("R$ " + subtotal.toFixed(2).replace(".", ","));

          },

          error: function(xhr, status, error) {
              console.log("Erro na solicitação AJAX: " + error);
          }
          });
      }
  });
});