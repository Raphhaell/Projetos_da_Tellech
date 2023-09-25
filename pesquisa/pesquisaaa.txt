document.getElementById("search-button").addEventListener("click", function() {

    var searchTerm = document.getElementById("search-input").value;

    search(searchTerm);

});

 

function search(searchTerm) {

    // Aqui você pode implementar a lógica de pesquisa real.

    // Por exemplo, você pode fazer uma solicitação AJAX para um servidor para buscar resultados.

    // Neste exemplo, apenas exibir uma mensagem de alerta.

    alert("Você pesquisou por: " + searchTerm);

}