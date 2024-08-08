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

### Билдим фронт для breeze, чтобы можно было использовать OAuth 2.0
```shell
sail npm install
sail npm run build
```

Теперь приложение доступно по адресу http://skillatest.com:1111

### Данные для авторизации
```
User: test@example.com
Password: password
```

### Postman
В файле postman.json лежит коллекция методов для Postman, ее нужно импортировать туда. Соответственно, нужно иметь установленный Postman. В коллекцию уже забиты тестовые данные, включая данные для авторизации. 

Чтобы авторизоваться, нужно перейти во вкладку Authorization у коллекции и получить токен, пройдя через стандартный OAuth процесс авторизации. После этого эндпоинты должны заработать.

Все должно работать из коробки, только что в метод для закрытия сессии нужно передать параметр token_id -- id сессии, которую хотите закрыть. 
