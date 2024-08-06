## Установка локальной среды
Для запуска используется Laravel Sail, поэтому необходимо иметь установленный Docker.

### Клонируем репозиторий
```shell
git clone git@github.com:reyadng/test-skilla.git
cd test-skilla
```

### Кладем .env файл в директорию проекта
https://gist.github.com/reyadng/4309ea2af610a5dbf88660c03707e39b

```shell
wget -q https://gist.githubusercontent.com/reyadng/4309ea2af610a5dbf88660c03707e39b/raw/ee596413b48faca9297512b3b346b7614de5b68a/.env
```

### Предварительная установка пакетов, чтобы можно было запустить Sail
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### Запускаем контейнеры
```shell
./vendor/bin/sail up -d
```
Если ругается на занятые порты, то можно попробовать стандартным образом изменить их в .env файле или же просто временно остановить уже запущенные на локальной машине контейнеры.

### Устанавливаем пакеты
```shell
./vendor/bin/sail composer install
```

### Генерируем ключи для Passport
```shell
./vendor/bin/sail artisan passport:keys
```

### Выполняем миграции и заполняем базу тестовыми данными
```shell
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

### Прописываем строку в hosts файл (/etc/hosts в Linux)
```
127.0.0.1 skillatest.com
```

Теперь приложение доступно по адресу http://skillatest.com:1111
Если есть желание прочекать oauth с выдачей авторизации на веб-морде, то нужно еще выполнить пару команд, чтобы сбилдить фронтенд breeze.
```shell
npm install
npm run build
```
### Postman
В файле postman.json лежит коллекция методов для Postman. Нужно запустить "Request Token from Password Client" для получения токена, после чего он автоматически запишется в глобальную переменную. Затем можно обращаться к другим эндпоинтам.
