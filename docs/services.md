# Services endpoint

> **!!TODO!!** Oldal újra formázása a users.md-hez hasonlóan.

get->services

	Visszadja az összes szerviz infot.
	Pl:
	{
		"service_id": 2,	
		"car_id": 3,	
		"service_date": "2018-12-03",	
		"runned_km": 200,	
		"need_to_fix": 0,	
		"ready_to_work": 0
	}

get->services/filter
	
	Egy 'field' és egy 'keyword' paramétert vár.
	field: melyik mező alapján akarsz lekérdezni,
	keyword: milyen értékkel.

get->services/serviceId

	Egy serviceId-t vár és visszaadja az adott szerviz infot.

post->services/insert

	Egy szerviz info beszúrása.

delete->services/serviceId

	Egy serviceId alapján törli az adott szerviz infot.

put->services/serviceId

	Egy serviceId alapján frissíti az adatokat az adott szerviz infon.


