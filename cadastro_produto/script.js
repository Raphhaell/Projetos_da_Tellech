// Array para armazenar os produtos
const produtos = [];

// Selecionando o formulário
const productForm = document.getElementById('product-form');


// Selecionando a lista de produtos
const productList = document.getElementById('product-list');

// Função para adicionar um produto
function addProduto(nome, descricao, quantidade, preco, idCategoria) {
    const produto = {
        nome: nome,
        descricao: descricao,
        quantidade: quantidade,
        preco: preco,
        idCategoria: idCategoria
    };
    produtos.push(produto);
}

// Função para exibir a lista de produtos
function displayProducts() {
    productList.innerHTML = '';
    produtos.forEach((produto, index) => {
        const productCard = document.createElement('div');
        productCard.className = 'card card-prod shadow mb-2';
        productCard.innerHTML = `
        <div class="card-header bg-warning">
                    <h4 class="text-white">${produto.nome}</h4>
                </div>
            <div class="card-body">
                
                <p class="card-text">Descrição: ${produto.descricao}</p>
                <p class="card-text">Quantidade: ${produto.quantidade}</p>
                <p class="card-text">Preço: ${produto.preco}</p>
                <p class="card-text">ID Categoria: ${produto.idCategoria}</p>
                <button onclick="deleteProduct(${index})" class="btn btn-danger">Excluir</button>
            </div>
        `;
        productList.appendChild(productCard);
    });
}

// Função para excluir um produto
function deleteProduct(index) {
    produtos.splice(index, 1);
    displayProducts();
}

productForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const nome = document.getElementById('nome').value;
    const descricao = document.getElementById('descricao').value;
    const quantidade = parseFloat(document.getElementById('price').value);
    const precoString = document.getElementById('Preço').value;
    const preco = parseFloat(precoString.replace('R$ ', '').replace(',', '.')); // Remova o prefixo "R$" e substitua a vírgula por ponto
    const idCategoria = document.getElementById('IdCategoria').value;

    if (nome && descricao && !isNaN(quantidade) && !isNaN(preco) && idCategoria) {
        addProduto(nome, descricao, quantidade, preco, idCategoria);
        displayProducts();
        productForm.reset();
    } else {
        alert('Preencha todos os campos corretamente.');
    }
});


// Inicialização do aplicativo
displayProducts();


// Selecionando o campo de input de preço
const inputPreco = document.getElementById('Preço');

// Adicionando um evento de input para formatar o preço enquanto o usuário digita
inputPreco.addEventListener('input', function (e) {
    const inputValue = e.target.value.replace(/\D/g, ''); // Remove todos os não dígitos (não números)
    const formattedValue = (parseFloat(inputValue) / 100).toFixed(2); // Divide por 100 e formata com 2 casas decimais
    e.target.value = 'R$ ' + formattedValue.replace('.', ','); // Adiciona o prefixo "R$" e substitui o ponto por vírgula
});
