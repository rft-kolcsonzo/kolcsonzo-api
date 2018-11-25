get->users/userId

    userId-t vár és visszaadja az adott user-t
    Pl:
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

post->users

    kötlező az email, jelszó, vezeték és kereszt név
    az email cím validálva van
    adatok pl:
    {
        "email": "teszt@teszt.hu",
        "password": "teszt",
        "firstname": "john",
        "lastname": "snow",
    }

post->users/login

    adatok pl:
    {
        "user_email": teszt@teszt.hu
        "password": teszt
    }

delete->users/userId

    user törlés

put->users/userId

    adatok pl:
    {
        "user_id": 1,
        "email": "teszt@teszt.hu",
        "password": "34228a532093278fcdc65c3a1338482e8bdc44f6",
        "firstname": "john",
        "lastname": "snow"
    }
