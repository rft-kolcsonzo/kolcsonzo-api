# Cars endpoint

> **!!TODO!!** Oldal �jra form�z�sa a users.md-hez hasonl�an.

get->cars

	Visszadja az �sszes kocsit.
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
	
	Egy 'field' �s egy 'keyword' param�tert v�r.
	field: melyik mez� alapj�n akarsz lek�rdezni,
	keyword: milyen �rt�kkel.

get->cars/carId

	Egy carId-t v�r �s visszaadja az adott kocsit.

post->cars/insert

	Egy kocsi besz�r�sa.

delete->cars/carId

	Egy carId alapj�n t�rli az adott kocsit.

put->cars/carId

	Egy carId alapj�n friss�ti az adatokat az adott kocsin.



