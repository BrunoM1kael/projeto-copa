
$(document).ready(function () {
    $('#buttons').hide();

    $('.match-container').each(function () {
        const container = $(this);
        const inputGol1 = container.find('.gols1');
        const inputGol2 = container.find('.gols2');

        const finalGol1 = parseInt(inputGol1.data('final')) || 0;
        const finalGol2 = parseInt(inputGol2.data('final')) || 0;

        inputGol1.val(0);
        inputGol2.val(0);

        const golsTime1Minutos = gerarMinutos(finalGol1);
        const golsTime2Minutos = gerarMinutos(finalGol2);

        const totalMinutos = 90;
        const duracaoSimulacao = 5000; 
        const intervalo = duracaoSimulacao / totalMinutos;
        let minutoAtual = 0;
        let placar1 = 0;
        let placar2 = 0;

        const timer = setInterval(function () {
            minutoAtual++;
            $('#timer').text("Minuto: " + minutoAtual);

            if (golsTime1Minutos.includes(minutoAtual)) {
                placar1++;
                inputGol1.val(placar1);
            }
            if (golsTime2Minutos.includes(minutoAtual)) {
                placar2++;
                inputGol2.val(placar2);
            }

            if (minutoAtual >= totalMinutos) {
                clearInterval(timer);
                $('#buttons').fadeIn();
            }
        }, intervalo);
    });

    $('.gols1, .gols2').on('change', function () {
        const partidaId = $(this).data('partida-id');
        const gols1 = $(this).closest('.resultado').find('.gols1').val();
        const gols2 = $(this).closest('.resultado').find('.gols2').val();

        $.ajax({
            url: "/sua-rota-para-salvar-resultado", 
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                partida_id: partidaId,
                gols1: gols1,
                gols2: gols2
            },
            success: function (response) {
                console.log('Resultado salvo com sucesso!');
            },
            error: function (xhr, status, error) {
                console.error("Erro ao salvar os dados: ", error);
            }
        });
    });
});
