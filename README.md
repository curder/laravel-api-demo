# Introduction

This project is about laravel reset-ful api demo.

```
git clone https://github.com/curder/laravel-api-demo.git

cd laravel-api-demo && composer install && cp .env.example .env && php artisan key:generate
```
change your database connection info, and run `php artisan migrate:refresh --seed`

## Get `access_token`

1. Run `php artisan passport:install` to get the `Client ID` and `Client Secret`

2. Also we should register a new user from this url `http://laravel-api-demo.dev/register`.

we can through postmen to send url `http://laravel-api-demo.dev/oauth/token`.

- `Headers`

```
Content-Type:application/json
```

- `Body`'s `raw` data 

```
{
	"grant_type": "password",
	"client_id" : 2, // our Client ID
	"client_secret": "o6U6ZaH0KDPwYSo35xAdxuutauP1JZPB4xOUg43z", // our client Secret
	"username": "curder@foxmail.com", // our register email
	"password": "aaaaaa" // our register password
}
```
to get the `Authorization` value.

when we insert, update or delete data will use it.

some postman.json data is [here](database/Laravel-Api-Demo.postman_collection.json)

## Some Urls 

```
GET /api/lessons Lesson List Data.
GET /api/lessons/1 Lesson Detail Data.
GET /api/tags Tag List Data.
GET /api/tags/1 Tag Detail Data.
...
```
