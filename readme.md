<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://styleci.io/repos/107368111"><img src="https://styleci.io/repos/107368111/shield?branch=master" alt="StyleCI"></a>
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](http://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Styde](https://styde.net)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Application

Данный проект является тестовым заданием по созданию простого новостного портала. Данный проект содержит 3 типа пользователей: гость, пользователь, администратор.

### Администратор может:
* добавлять, удалять, редактировать и скрывать посты
* удалять комментарии пользователей
* банить пользователей на время
* смотреть список пользователей

### Пользователь может:
* полностью просматривать новость
* комментировать, редактировать свои комментарии (доступно в первые 5 минут после отправки сообщения)

### Гость может:
* просматривать только краткое содержание новости (первых 300 символов)

### Другая функциональность:
* интерфейс сайта локализован (русский, украинский, английский)
* админка с журналом логов
* при регистрации, создании поста (категории) отправляется пользователю сообщение на почту
* отправка почты выполняется в очереди
* авторизация через вк, google, github

## Requirements

### require:
* php: >=7.0.0
* anhskohbo/no-captcha: ^3.0
* caouecs/laravel-lang: ^3.0
* fideloper/proxy: ~3.3
* laravel/framework: 5.5.*
* laravel/tinker: ~1.0
* laravelcollective/html: ^5.5
* predis/predis: ^1.1
* rap2hpoutre/laravel-log-viewer: ^0.10.4
* recca0120/laravel-tracy: ^1.8
* socialiteproviders/google: ^3.0
* socialiteproviders/vkontakte: ^3.0

### require-dev:
* filp/whoops: ~2.0
* fzaninotto/faker: ~1.4
* mockery/mockery: 0.9.*
* phpunit/phpunit: ~6.0

## Stages
* Перенес модели в папку Models, добавил панель для дебага
* Добавил стандартный фукционал авторизации
* Добавил разделение по ролям пользователей
* Добавил основные модели новостного портала
* Добавил фабрики и сиды для тестовых заполнений
* Разделил "роуты" в соответствии с правами пользователей
* Добавил локализацию
* Добавил авторизацию через социальные сети
* Добавил отправку сообщений в очереди
* Добавил панель администратора
* Написал тесты
* Проводил мелкие исправления