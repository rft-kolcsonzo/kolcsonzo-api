# Users endpoint

[vissza](index.md)

## **GET** /users/:userId
userId-t vár és visszaadja az adott user-t

### Response
```json
{
    "user_id": 1,
    "email": "teszt@teszt.hu",
    "firstname": "john",
    "lastname": "snow",
    "profile_img": null,
    "is_admin": 1,
    "enabled_status": 1,
    "deleted": 0
}
```

## **POST** /users
kötlező az email, jelszó, vezeték és keresztnév
az email cím validálva van.

### Request
```json
{
    "email": "teszt@teszt.hu",
    "password": "teszt",
    "firstname": "john",
    "lastname": "snow"
}
```

### Response
```json
{
    "user_id": 1,
    "email": "teszt@teszt.hu",
    "firstname": "john",
    "lastname": "snow",
    "profile_img": null,
    "is_admin": 1,
    "enabled_status": 1,
    "deleted": 0
}
```

## **DELETE** /users/:userId
Adott user törlése.

## **PUT** /users/:userId
Adott user módosítása

### Request
```json
{
    "user_id": 1,
    "email": "teszt@teszt.hu",
    "firstname": "john",
    "lastname": "snow"
}
```

### Response
```json
{
    "user_id": 1,
    "email": "teszt@teszt.hu",
    "password": "34228a532093278fcdc65c3a1338482e8bdc44f6",
    "firstname": "john",
    "lastname": "snow",
    "profile_img": null,
    "is_admin": 1,
    "enabled_status": 1,
    "deleted": 0
}
```