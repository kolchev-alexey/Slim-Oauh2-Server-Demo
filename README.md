# Slim-OAuth2-Server-Demo

## Overview

This project is REST api skeleton whith league/oauth2-server, doctrine/orm and tests.
Based on https://github.com/ElisDN/rabbit-demo-spa

## Running the app

Configure .env file

Generate private and public keys

```bash
openssl genrsa -out private.key 2048
openssl rsa -in private.key -pubout -out public.key
```

Typing `composer serve` in a console will install the project dependencies, create the database and open
the API at `http://localhost:8000`

## Running the tests

`composer test`


## Curl requests

```bash
Send json
curl -X POST localhost:8000/auth/signup -H 'Content-Type: application/json' -d '{"email":"email@ya.ru","password":"password"}'
curl -X POST localhost:8000/auth/signup/confirm -H 'Content-Type: application/json' -d '{"email":"email@ya.ru","token":"token"}'
curl -X POST localhost:8000/oauth/auth -H 'Content-Type: application/json' -d '{"grant_type": "password", "username": "email@ya.ru", "password": "password", "client_id": "app", "client_secret": "", "access_type": "offline"}';

curl -X GET localhost:8000/profile -H 'Authorization: Bearer {token}'

multipart/form-data
curl -X POST localhost:8000/auth/signup -d 'email=email@ya.ru&password=password'

Uploading file
curl -X POST http://example.com/upload -F 'image=@/home/user/Pictures/wallpaper.jpg'
```