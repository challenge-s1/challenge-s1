# Challenge app

## Project setup

```sh
docker compose build --pull --no-cache
docker-compose up -d
docker-compose exec client npm install
```

## Lunch client

```sh
docker-compose exec client npm run dev
```

## APi

```sh
docker compose exec php composer install
```

```sh
docker-compose exec php php bin/console d:s:u --force
```

```sh
docker-compose exec php php bin/console doctrine:fixtures:load -n
```
