// Função para mostrar/ocultar a área de comentários
document.querySelectorAll('.comment').forEach((commentButton, index) => {
    const commentArea = document.querySelectorAll('.commentArea')[index];
    commentArea.style.display = 'none'; // Inicialmente, oculte a área de comentários.

    commentButton.addEventListener('click', () => {
        commentArea.style.display = commentArea.style.display === 'none' ? 'block' : 'none';
    });
});


// Função para contar curtidas e alterar a cor do botão
document.querySelectorAll('.like').forEach((likeButton, index) => {
    let likeCount = document.querySelectorAll('.likeCount')[index];
    let count = 0;

    likeButton.addEventListener('click', () => {
        if (likeButton.classList.contains('liked')) {
            likeButton.classList.remove('liked');
            count--;
        } else {
            likeButton.classList.add('liked');
            count++;
        }

        likeButton.style.color = likeButton.classList.contains('liked') ? '#b9d2de' : 'white';

        likeCount.textContent = count;
    });
});


    const fileInput = document.getElementById('image');
    const fileNameDisplay = document.getElementById('file-name');

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = `${fileInput.files[0].name}`;
        } else {
            fileNameDisplay.textContent = ''; // Limpar o nome do arquivo se nenhum arquivo estiver selecionado
        }
    });