const btnProximo = document.querySelector('.proximo');
const btnAnterior = document.querySelector('.anterior');
const center = document.querySelector('.center');

btnProximo.addEventListener('click', () => {
  center.scrollBy({ left: 300, behavior: 'smooth' });
});

btnAnterior.addEventListener('click', () => {
  center.scrollBy({ left: -300, behavior: 'smooth' });
});

//  fim do carrocel

function speak(text) {
    
    if ('speechSynthesis' in window) {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'pt-BR';
        window.speechSynthesis.cancel(); // parar de falar antes
        window.speechSynthesis.speak(utterance);
    }
    

}


// seleciona todos os elementos da tela para leitura

document.querySelectorAll('[data-tts]').forEach(el =>{

    const texto = el.getAttribute('data-tts');

    //falar ao clicar
    el.addEventListener('click', function(){

        speak(texto);

    });

    // falar ao focar

    el.addEventListener('focus', function(){

        speak(texto);

    });

});

// link de redefiniçao de senha 
 function enviarEmail(event){
    event.preventDefault();
    const msg = document.getElementById('mensagem');
    msg.style.display = "block";

    // Desativar p input e o button
    document.getElementById('email').disabled = true;
    event.target.querySelectorAll("button").disabled = true;
    setTimeout(() => {
        window.location.href = "index.html"
    }, 5000);
 }


 let pixel = 0.5; // aumenta pu diminui por pixel

 function aumentarFonte(){

    const elementos = document.querySelectorAll('body, body *');

    elementos.forEach(el =>{

        const estilo = window.getComputedStyle(el);
        const tamanho = parseFloat(estilo.fontSize);

        if (!isNeN(tamanho)){
            el.style.fontSize = (tamanho + pixel) + "px";
        }
    });
 }
 
 
 function diminuirFonte(){

    const elementos = document.querySelectorAll('body, body *');

    elementos.forEach(el =>{

        const estilo = window.getComputedStyle(el);
        const tamanho = parseFloat(estilo.fontSize);

        if (!isNeN(tamanho)){
            el.style.fontSize = (tamanho - pixel) - "px";
        }
        
    });
 } 
