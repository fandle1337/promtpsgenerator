# Развёртывание приложения
---
---
1. Переименовать auth.json.template и .env.template в .auth.json и .env.
2. Заполнить в .env данные для доступа к базе данных
3. Добавить ключи авторизации в .auth.json.
4. Выполнить установку пакетов composer и npm.
```
composer install
npm ci
```
5. Выполнить миграции
```
vendor/bin/phinx migrate -e development
```
6. Добавить в таблицу portals запись с доменом из .auth.json, другие поля могут быть любыми
7. Запустить приложение
```
npm run watch
```