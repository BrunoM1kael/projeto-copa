
# Copa do Mundo - Simulação de Partidas

Este projeto simula partidas da Copa do Mundo utilizando Laravel. As partidas são simuladas dinamicamente, com gols sendo atribuídos ao longo dos minutos e um sistema de exibição do tempo do jogo.

## Requisitos

- PHP 8.1 ou superior
- Composer
- MySQL (ou outro banco de dados compatível com Laravel)

## Instalação

1. Clone o repositório:
   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git](https://github.com/BrunoM1kael/projeto-copa.git
   cd seu-repositorio
   ```

2. Instale as dependências do Laravel:
   ```sh
   composer update
   ```

3. Crie um banco de dados chamado `copa` no MySQL:
   ```sql
   CREATE DATABASE copa;
   ```

4. Configure o arquivo `.env`:
   - Copie o arquivo de exemplo:
     ```sh
     cp .env.example .env
     ```
   - Atualize as configurações do banco de dados no `.env`:
     ```env
     DB_DATABASE=copa
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```

5. Execute as migrações do banco de dados:
   ```sh
   php artisan migrate
   ```

6. Inicie o servidor do Laravel:
   ```sh
   php artisan serve
   ```

7. (Opcional) Caso o projeto tenha frontend em Vue.js:
   ```sh
   npm install
   npm run dev
   ```

## Funcionalidades

- Simulação automática de partidas com atualização do placar ao longo do tempo.
- Exibição do tempo do jogo em tempo real.
- Exibição de botões de "Classificação" e "Próxima Rodada" após 90 minutos de jogo.
- Integração com o banco de dados para salvar os resultados.

## Uso

1. Acesse o sistema pelo navegador:
   ```sh
   http://127.0.0.1:8000
   ```
2. Acompanhe a simulação das partidas.
3. Após 90 minutos simulados, os botões de classificação e próxima rodada serão exibidos.

## Dúvidas ou Problemas?

Abra uma issue no repositório ou entre em contato com o desenvolvedor.

---
Desenvolvido com Laravel e paixão por futebol! ⚽
