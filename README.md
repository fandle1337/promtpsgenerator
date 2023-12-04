# Установка приложения

---
Внести адреса репозитория приватных пакетов
---
```
composer config --global --editor
```

В открывшемся редакторе внести код

```
{
    "config": {
    "disable-tls": true
    },
"repositories": [
{
     "type": "git",
     "url": "git@gitflic.ru:skyweb24/skeleton.git"
},
{
     "type": "git",
     "url": "git@gitflic.ru:skyweb24/composerpackage-sw24-bitrix24-cache.git"
},
{
     "type": "git",
     "url": "git@gitflic.ru:skyweb24/composerpackage-sw24-rest-sdk.git"
},
{
     "type": "git",
     "url": "git@gitflic.ru:skyweb24/composerpackage-sw24-bitrix24-auth.git"
}
]
}
```

---

Приложение необходимо развернуть обязательно в директории ```/b24/``` !!!
---

Выполните команду в консоле внутри директории ```/b24/```

```
composer create-project skyweb24/skeleton  .
```
---

Выполнить команду в корне проекта ```/b24/```

```
npm install
```
---

Выполнить команду в корне проекта  ```/b24/``` для сборки фронта

```
npm run build
```
---

Скопируйте файл ```.env.template``` с новым названием ```.env```<br>

---

Если вы разрабатываете локально, Скопируйте файл ```.auth.json.template``` с новым названием ```.auth.json```. И заполните его

---

Сайт будет доступен по ```site.ru/b24/index.php```

# Директории

+ Директори для API ```/b24/api/```<br>
+ Директория для Фронт ```/b24/app/```

При обращении к http://site.ru/b24/index.php все запросы отправляются на директорию ```/b24/app/index.php```.<br>
При обращении к http://site.ru/b24/api/index.php все запросы отправляются на директорию ```/b24/api/index.php```.


# Дополнительно
---
Скрипт получения авторизации фрейма:<br>
---
JSON.stringify({"domain": location.hostname, "access_token": document.querySelector("input[name='AUTH_ID']").value,"refresh_token": document.querySelector("input[name='REFRESH_ID']").value, "member_id": document.querySelector("input[name='member_id']").value, "dateStart": 0, "dateEnd": 0});






