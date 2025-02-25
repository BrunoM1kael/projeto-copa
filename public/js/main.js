function gerarMinutos(qtd) {
    let minutos = [];
    while (minutos.length < qtd) {
        let min = Math.floor(Math.random() * 90) + 1;
        if (!minutos.includes(min)) {
            minutos.push(min);
        }
    }
    return minutos.sort((a, b) => a - b);
}
