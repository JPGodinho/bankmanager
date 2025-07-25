document.addEventListener('DOMContentLoaded', function() {
    const inputBusca = document.getElementById('buscaAlunoInput');
    const tabelaAlunos = document.getElementById('tabelaAlunos');
    const linhasTabela = tabelaAlunos.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    inputBusca.addEventListener('keyup', function() {
        const filtro = inputBusca.value.toLowerCase();

        for (let i = 0; i < linhasTabela.length; i++) {
            const celulas = linhasTabela[i].getElementsByTagName('td');
            let encontrou = false;

                
            if (celulas.length > 0) {
                const nome = celulas[0].textContent.toLowerCase();
                const email = celulas[1].textContent.toLowerCase();

                if (nome.includes(filtro) || email.includes(filtro)) {
                    encontrou = true;
                }
            }

            
            if (encontrou) {
                linhasTabela[i].style.display = ''; 
            } else {
                linhasTabela[i].style.display = 'none';
            }
        }
    });
});