

get->services

	Visszadja az �sszes szerviz infot.
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
	
	Egy 'field' �s egy 'keyword' param�tert v�r.
	field: melyik mez� alapj�n akarsz lek�rdezni,
	keyword: milyen �rt�kkel.

get->services/serviceId

	Egy serviceId-t v�r �s visszaadja az adott szerviz infot.

post->services/insert

	Egy szerviz info besz�r�sa.

delete->services/serviceId

	Egy serviceId alapj�n t�rli az adott szerviz infot.

put->services/serviceId

	Egy serviceId alapj�n friss�ti az adatokat az adott szerviz infon.


