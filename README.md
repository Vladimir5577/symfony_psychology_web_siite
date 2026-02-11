# symfony_psychology_web_siite

### Install in docker:
1. Copy .env.example to .env (optionally put you credentials inside).
```bash
$ cp .env .env.local
````

2. Build docker --- only for the first time
```bash
$ docker-compose build
```

3. Run in docker
```bash
$ docker-compose up
```

4. Go to php container
```bash
$  docker exec -it php_container bash
```

5. Inside container install dependancies
```bash
$ composer install
```

6. Go to database - in browser and make sure database created
```web
http://localhost:8087/
```

7. Run migrations (make sure that database exist)
```bash
$ php bin/console doctrine:migrations:migrate
```

8. Optionally load fixtures
```bash
$ php bin/console doctrine:fixtures:load
```

9. Give permissions to public/uploads and media folder
```bash
$ sudo chmod -R 775 public/uploads
$ sudo chmod -R 775 public/media
```

## Xdebug

1. Добавить конфигурацию для xdebug -> php web page
2. Там же добавить сервер - symfony_app (в docker-compose.yml PHP_IDE_CONFIG)
3. Прописать хост - 0.0.0.0 и путь на сервере к проекту - /var/www/html
