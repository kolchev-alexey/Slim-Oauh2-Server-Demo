openssl genrsa -out private.key 2048
openssl rsa -in private.key -pubout -out public.key


Send json
curl -X POST localhost:8000/auth/signup -H 'Content-Type: application/json' -d '{"email":"email@ya.ru","password":"password"}'
curl -X POST localhost:8000/auth/signup/confirm -H 'Content-Type: application/json' -d '{"email":"email@ya.ru","token":"token"}'
curl -X POST localhost:8000/oauth/auth -H 'Content-Type: application/json' -d '{"grant_type": "password", "username": "email@ya.ru", "password": "password", "client_id": "app", "client_secret": "", "access_type": "offline"}';

{"token_type":"Bearer","expires_in":3600,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI0YjU1ZDRkYTJhZGI5YmQ5OWFlOTI4YTFhMjBhYjBlOTJlZTg5MGUyOGY0ZGE2ODRmOWY0NjUxNzI0MDFhZGM3ODY4OTI2ZjM1ZWZjOGI2In0.eyJhdWQiOiJhcHAiLCJqdGkiOiJiNGI1NWQ0ZGEyYWRiOWJkOTlhZTkyOGExYTIwYWIwZTkyZWU4OTBlMjhmNGRhNjg0ZjlmNDY1MTcyNDAxYWRjNzg2ODkyNmYzNWVmYzhiNiIsImlhdCI6MTYzNjQ1MTQzMSwibmJmIjoxNjM2NDUxNDMxLCJleHAiOjE2MzY0NTUwMzEsInN1YiI6IjU4M2I3NGFkLWU4MmQtNGRhMC1hZTczLWE4MzYwOTQ3ZjhkMSIsInNjb3BlcyI6W119.JeXxtuSdY9vrqz9IoAFHeS3DwwTrrgb-KhtTqk5prLujUYrRB2AGE9FEPEgO14Hm4AO2KGUCmyD88fs0lHg8v97M9RrlFodIL08K1r5UIkvRNkL93MM8E7P6lF56FxWiX2vpxvPUTYNKxPALxmCE27VPbY6dWJRB6Al6wT-plyccpUsGVs0DDcaRrcIukgeu_H_2NzCyV5N1Yebl87gQHIu9wdvBZtPGbH1Wjdaymhz9euHLyBDXVrIWE1O3z4HLTyMN3UCkWoIWg78Q1GyKMz6pFiqUfmUHeSequ16DCEFyjONlbIZne8hIfgdFd7z6cPCQT55Ox_S2ANeVmZ41QQ","refresh_token":"def50200ea9f4d58236a81da6a6555e123ad8b68f3ff8b20bbef563af62ea150ecd634c37d8db7edbac4d685079208c9306ea95d148656e789222b441cb3336a813938ed994cfa43dbaad088117fda44fcbaf41e3b10ff61be20b29a2a78bc2c01fa7f776cef20b9e36b4c4fb7705f4ee3d6a900b9fe8b8c590a8bc836d1251cccd9829f87faa887b38bc5ab5c1a5de51c4fda6a5a58a18367b2cd9bf3d32c2c08d08af3928a999be2b2ada32f2fa88587e774b6f8e4f0e6fa8d5794ab8974291f197cdaa0e318810cd00bbeb3ba7fc27e97c9ef2c070589c2496645f3d133737ef2fe8cfd2235f9394a76ecbb37948d9aaa427cf58eaf7518930201215610c8a9765db0f3437a4e368ea8a89a4e590f8bb091b5113f8d86f3f7eb5fef0fd4ff3d7e17c0b3f7792d6cd18b79df037146db6af7b9f9bf7508240ce2865e56cc3cff998b70458f74b423c782cc83c21e23818f0f187926d6ae98002b1d25ed177e6cc040616461c9fe373877c48f4b87d295dce324c8c5e274c4d810f7fe2f37e465bbca6fa17e15a5"}

curl -X GET localhost:8000/profile -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI0YjU1ZDRkYTJhZGI5YmQ5OWFlOTI4YTFhMjBhYjBlOTJlZTg5MGUyOGY0ZGE2ODRmOWY0NjUxNzI0MDFhZGM3ODY4OTI2ZjM1ZWZjOGI2In0.eyJhdWQiOiJhcHAiLCJqdGkiOiJiNGI1NWQ0ZGEyYWRiOWJkOTlhZTkyOGExYTIwYWIwZTkyZWU4OTBlMjhmNGRhNjg0ZjlmNDY1MTcyNDAxYWRjNzg2ODkyNmYzNWVmYzhiNiIsImlhdCI6MTYzNjQ1MTQzMSwibmJmIjoxNjM2NDUxNDMxLCJleHAiOjE2MzY0NTUwMzEsInN1YiI6IjU4M2I3NGFkLWU4MmQtNGRhMC1hZTczLWE4MzYwOTQ3ZjhkMSIsInNjb3BlcyI6W119.JeXxtuSdY9vrqz9IoAFHeS3DwwTrrgb-KhtTqk5prLujUYrRB2AGE9FEPEgO14Hm4AO2KGUCmyD88fs0lHg8v97M9RrlFodIL08K1r5UIkvRNkL93MM8E7P6lF56FxWiX2vpxvPUTYNKxPALxmCE27VPbY6dWJRB6Al6wT-plyccpUsGVs0DDcaRrcIukgeu_H_2NzCyV5N1Yebl87gQHIu9wdvBZtPGbH1Wjdaymhz9euHLyBDXVrIWE1O3z4HLTyMN3UCkWoIWg78Q1GyKMz6pFiqUfmUHeSequ16DCEFyjONlbIZne8hIfgdFd7z6cPCQT55Ox_S2ANeVmZ41QQ'



multipart/form-data
curl -X POST localhost:8000/auth/signup -d 'email=email@ya.ru&password=password'

Uploading file
curl -X POST http://example.com/upload -F 'image=@/home/user/Pictures/wallpaper.jpg'