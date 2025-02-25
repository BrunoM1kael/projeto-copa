$(document).ready(function() {
    const totalMinutos = 90;
    const duracaoSimulacao = 5000; 
    const intervalo = duracaoSimulacao / totalMinutos;
    let minutoAtual = 0;

    $('.match').each(function() {
        const match = $(this);
        const finalGol1 = parseInt(match.data('final-gols1')) || 0;
        const finalGol2 = parseInt(match.data('final-gols2')) || 0;

        match.find('.display-score').text('0 x 0');

        match.data('gols1-minutos', gerarMinutos(finalGol1));
        match.data('gols2-minutos', gerarMinutos(finalGol2));

        match.data('score1', 0);
        match.data('score2', 0);
    });

    const timerInterval = setInterval(function() {
        minutoAtual++;
        $('#timer').text("Minuto: " + minutoAtual);

        $('.match').each(function() {
            const match = $(this);
            let score1 = match.data('score1');
            let score2 = match.data('score2');
            const gols1Minutos = match.data('gols1-minutos');
            const gols2Minutos = match.data('gols2-minutos');

            if ($.inArray(minutoAtual, gols1Minutos) !== -1) {
                score1++;
                match.data('score1', score1);
            }
            if ($.inArray(minutoAtual, gols2Minutos) !== -1) {
                score2++;
                match.data('score2', score2);
            }
            match.find('.display-score').text(score1 + " x " + score2);
        });

        if (minutoAtual >= totalMinutos) {
            clearInterval(timerInterval);
            $('.penalty').fadeIn();
            $('#buttons').fadeIn();
        }
    }, intervalo);
});
