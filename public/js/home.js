document.addEventListener('DOMContentLoaded', function() {
    const btnCopaDoMundo = document.getElementById('btn-copa-do-mundo');
    const btnSuperMundial = document.getElementById('btn-super-mundial');
    const btnVoltarCopa = document.getElementById('btn-voltar-copa');
    const btnVoltarSuper = document.getElementById('btn-voltar-super');
    const configCopaDoMundo = document.getElementById('config-copa-do-mundo');
    const configSuperMundial = document.getElementById('config-super-mundial');
    const competitionSelection = document.querySelector('.competition-selection');

    btnCopaDoMundo.addEventListener('click', () => {
        configCopaDoMundo.style.display = 'block';
        configSuperMundial.style.display = 'none';
        competitionSelection.style.display = 'none';
    });

    btnSuperMundial.addEventListener('click', () => {
        configCopaDoMundo.style.display = 'none';
        configSuperMundial.style.display = 'block';
        competitionSelection.style.display = 'none';
    });

    btnVoltarCopa.addEventListener('click', () => {
        configCopaDoMundo.style.display = 'none';
        competitionSelection.style.display = 'flex';
    });

    btnVoltarSuper.addEventListener('click', () => {
        configSuperMundial.style.display = 'none';
        competitionSelection.style.display = 'flex';
    });
});
