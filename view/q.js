const folha = document.getElementById('folha');

function aleatorio_entre(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
  }

function alvo() {
    return '<span class="alvo"><i class="bi bi-0-circle"></i> <i class="bi bi-0-circle-fill"></i> <i class="bi bi-activity"></i></span>';
}
function simbolo_aleatorio() {
    const lista_simbolos = ['<i class="bi bi-0-circle alvo"></i>',
                            '<i class="bi bi-0-circle-fill"></i>',
                            '<i class="bi bi-activity"></i>',
                            '<i class="bi bi-arrows-angle-contract"></i>',
                            '<i class="bi bi-arrows-collapse"></i>',
                            '<i class="bi bi-aspect-ratio-fill"></i>']
    return lista_simbolos[aleatorio_entre(0, lista_simbolos.length)]
}

//const simbolos = [alvo(), simbolo_aleatorio()];
function inserir() {
    var simbolos_inner = [];
    var alvos = 0;
    console.log('oi')
    while (simbolos_inner.length < 3000) {
        var simbolo = aleatorio_entre(0, 2);
        if (simbolo == 0) {
            alvos++;
            if (alvos < 11) {
                simbolos_inner.push(alvo());
            } else {
                simbolos_inner.push(simbolo_aleatorio());
            }
        } else {
            simbolos_inner.push(simbolo_aleatorio())
        }
    }
    var folha_inner = '';
    for (var i=0; i < simbolos_inner.length; i++) {
        folha_inner += simbolos_inner[i] + ' ';
    }
    folha.innerHTML = folha_inner;
}

const contador_acertos = document.getElementById('acertos');

inserir();

var acertos = 0;
function encontrar() {
    acertos++;
    contador_acertos.innerHTML = acertos;
    this.removeEventListener('click', encontrar);
}

alvos_botao = document.getElementsByClassName('alvo');
for (var a=0; a < alvos_botao.length; a++) {
    addEventListener('click', encontrar);
}