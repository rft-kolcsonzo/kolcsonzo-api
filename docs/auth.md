# Auth endpoint

[vissza](index.md)

## **POST** /auth/login

### Request
```json
{
    "user_email": "teszt@teszt.hu",
    "password": "teszt"
}
```

### Response
```json
{
    "type": "accesToken",
    "token": "fghfjgdjdjkdjkdkdktud33k3k3ukd3k",
    "created_time": "2018-11-25 11:11:20" 
}
```
## **POST** /auth/token

### Request
```json
{
    "token": "token"
}
```

### Response
```json
{
    "is_admin": 1
}
```