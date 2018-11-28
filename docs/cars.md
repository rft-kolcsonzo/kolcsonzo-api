# Cars endpoint

> **!!TODO!!** Oldal újra formázása a users.md-hez hasonlóan.

get->cars

	Visszadja az összes kocsit.
	Pl:
	{
		"car_id": 1,	
		"modell": "model_nev",	
		"type": "tipus",	
		"factory_id": "gyartasi_szam",	
		"persons": 2,	
		"doors_number": 4,	
		"category": "kategoria",	
		"tags": "tag",	
		"color": "piros",
		"born_date": "2018-01-02",	
		"insurance_name": "biztositas neve",	
		"insurance_id": "biztositas szama",	
		"insurance_until_date": "2020-11-02",
		"car_status_details": "A kocsirol egy leiras, hogy mi is van vele.",	
		"available_status": 1

	}

get->cars/filter
	
	Egy 'field' és egy 'keyword' paramétert vár.
	field: melyik mezõ alapján akarsz lekérdezni,
	keyword: milyen értékkel.

get->cars/carId

	Egy carId-t vár és visszaadja az adott kocsit.

post->cars/insert

	Egy kocsi beszúrása.

delete->cars/carId

	Egy carId alapján törli az adott kocsit.

put->cars/carId

	Egy carId alapján frissíti az adatokat az adott kocsin.



