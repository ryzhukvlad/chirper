# Chirper

## О проекте

Веб-приложение, построенное с использованием фреймворка [Laravel](https://github.com/laravel/laravel) 
на основе материалов [Laravel Bootcamp](https://bootcamp.laravel.com/)

Приложение представляет из себя микроблог с аутентификацией

### Технические спецификации
- PHP: 8.2
- Laravel 10
- MySQL 8.0
- Redis

## Запуск проекта

Настройка локально окружения осуществляется с помощью [Laravel Sail](https://laravel.com/docs/10.x/sail)

Для запуска приложения достаточно иметь установленный [Docker](https://www.docker.com/) 
и доступ к CLI Unix-сиcтемы (WSL в случае Windows)

### Порядок действий

- Установить [alias для Sail](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias) 
в конфигурации командной оболочки

- Запустить сборку контейнеров, выполнив из папки проекта команду:
```shell
sail up -d
```

- Запустить сервер Vite:
```shell
sail npm run dev
```

- Установить миграции для базы данных:
```shell
sail artisan migrate --seed
```
