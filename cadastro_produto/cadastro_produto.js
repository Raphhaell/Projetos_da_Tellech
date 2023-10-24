// Função para formatar o campo de preço

function formatPrice(input) {

  let numericValue = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

 

  // Se o valor não for vazio, formate-o

  if (numericValue !== '') {

    let floatValue = parseFloat(numericValue) / 100; // Dividir por 100 para tratar como centavos

    input.value = `R$ ${floatValue.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;

  }

}