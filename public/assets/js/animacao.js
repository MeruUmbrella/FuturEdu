$(document).ready(function () {
    $('.caixas').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
$('.carrossel').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
  });

  document.addEventListener('DOMContentLoaded', () => {
    const textareas = document.querySelectorAll('textarea');
  
    textareas.forEach((textarea) => {
      textarea.addEventListener('click', () => {
        textarea.classList.toggle('active');
      });
    });
  });

  window.addEventListener('scroll', function () {
    const header = document.querySelector('.header');
    const scrollThreshold = 650;

    if (window.scrollY > scrollThreshold) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const modalContainer = document.getElementById('modalContainer');
    const openLoginModal = document.getElementById('openLoginModal');

    let modal; // vai guardar o modal carregado

    openLoginModal.addEventListener('click', async (e) => {
        e.preventDefault();

        // Se o modal já foi carregado, só mostra
        if (modal) {
            modal.style.display = 'flex';
            return;
        }

        // Carrega o HTML do modal via fetch
        try {
            const response = await fetch('Login');

            const html = await response.text();

            // Insere o modal no container
            modalContainer.innerHTML = html;

            // Agora pega o modal e os elementos para a lógica
            modal = document.getElementById('loginModal');
            const fecharBtn = modal.querySelector('.fechar');
            const btnLogin = modal.querySelector('#btnLogin');
            const btnCadastro = modal.querySelector('#btnCadastro');
            const formLogin = modal.querySelector('#formLogin');
            const formCadastro = modal.querySelector('#formCadastro');

            // Exibe o modal
            modal.style.display = 'flex';

            // Eventos para fechar modal
            fecharBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Alternar para login
            btnLogin.addEventListener('click', () => {
                btnLogin.classList.add('active');
                btnCadastro.classList.remove('active');
                formLogin.style.display = 'block';
                formCadastro.style.display = 'none';
            });

            // Alternar para cadastro
            btnCadastro.addEventListener('click', () => {
                btnCadastro.classList.add('active');
                btnLogin.classList.remove('active');
                formLogin.style.display = 'none';
                formCadastro.style.display = 'block';
            });

        } catch (error) {
            console.error('Erro ao carregar modal:', error);
        }
    });
});


// Efeito de foco nos inputs
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Simulação de envio do formulário
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const button = this.querySelector('.btn-enviar');
    const originalText = button.innerHTML;
    
    // Animação de loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
    button.disabled = true;
    
    setTimeout(() => {
        // Mostrar mensagem de sucesso
        document.getElementById('mensagem-sucesso').style.display = 'block';
        
        // Resetar formulário
        this.reset();
        
        // Restaurar botão
        button.innerHTML = originalText;
        button.disabled = false;
        
        // Ocultar mensagem após 5 segundos
        setTimeout(() => {
            document.getElementById('mensagem-sucesso').style.display = 'none';
        }, 5000);
    }, 2000);
});

// Animação de digitação no textarea
document.getElementById('mensagem').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
});

// Efeito parallax suave
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.contato');
    const speed = scrolled * 0.5;
    
    if (parallax) {
        parallax.style.transform = `translateY(${speed}px)`;
    }
});
