document.addEventListener('DOMContentLoaded', function () {
  // Criar o botão de voltar ao topo
  const backToTopButton = document.createElement('button');
  backToTopButton.innerText = 'Voltar ao Topo';
  backToTopButton.id = 'back-to-top';
  backToTopButton.style.position = 'fixed';
  backToTopButton.style.bottom = '20px';
  backToTopButton.style.right = '20px';
  backToTopButton.style.display = 'none'; // Inicialmente escondido
  backToTopButton.style.padding = '10px 15px';
  backToTopButton.style.backgroundColor = '#d4af37'; // Cor amarela
  backToTopButton.style.color = '#000'; // Cor do texto
  backToTopButton.style.border = 'none';
  backToTopButton.style.borderRadius = '5px';
  backToTopButton.style.cursor = 'pointer';
  backToTopButton.style.transition = 'opacity 0.3s';
  document.body.appendChild(backToTopButton);

  // Mostrar o botão quando rolar a página para baixo
  window.onscroll = function() {
      if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
          backToTopButton.style.display = 'block';
      } else {
          backToTopButton.style.display = 'none';
      }
  };

  // Função para voltar ao topo ao clicar no botão
  backToTopButton.onclick = function() {
      window.scrollTo({
          top: 0,
          behavior: 'smooth'
      });
  };
});
