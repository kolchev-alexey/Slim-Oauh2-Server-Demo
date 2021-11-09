openssl genrsa -out private.key 2048
openssl rsa -in private.key -pubout -out public.key


Send json
curl -X POST localhost:8000/auth/signup -H 'Content-Type: application/json' -d '{"email":"email@ya.ru","password":"password"}'
curl -X POST localhost:8000/auth/signup/confirm -H 'Content-Type: application/json' -d '{"email":"email@ya.ru","token":"token"}'
curl -X POST localhost:8000/oauth/auth -H 'Content-Type: application/json' -d '{"grant_type": "password", "username": "email@ya.ru", "password": "password", "client_id": "app", "client_secret": "", "access_type": "offline"}';

curl -X GET localhost:8000/profile -H 'Authorization: Bearer token'


multipart/form-data
curl -X POST localhost:8000/auth/signup -d 'email=email@ya.ru&password=password'

Uploading file
curl -X POST http://example.com/upload -F 'image=@/home/user/Pictures/wallpaper.jpg'