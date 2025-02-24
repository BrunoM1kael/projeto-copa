# Copa do Mundo - Simulação de Partidas

Este projeto simula partidas da Copa do Mundo utilizando Laravel. As partidas são simuladas dinamicamente, com gols sendo atribuídos ao longo dos minutos e um sistema de exibição do tempo do jogo.

## Requisitos

- PHP 8.1 ou superior
- Composer
- MySQL (ou outro banco de dados compatível com Laravel)

## Instalação

1. Clone o repositório:
   ```sh
   git clone https://github.com/seu-usuario/seu-repositorio.git
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









<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#   p r o j e t o - c o p a 
 
 
