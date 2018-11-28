# Images endpoint

> **!!TODO!!** Oldal újra formázása a users.md-hez hasonlóan.

get->images

	Visszadja az �sszes kocsi k�p infot.
	
	Pl:
	{
		"file_id": 5,
		"car_id": 3,
		"filename": "Kir�ly lada.jpg",
		"pathdir": "pics",
		"pathur": "file:///c://this/is/a/path/to/pics"
	}

get->images/filter
	
	Egy 'field' �s egy 'keyword' param�tert v�r.
	field: melyik mez� alapj�n akarsz lek�rdezni,
	keyword: milyen �rt�kkel.

get->images/imageId

	Egy imageId-t v�r �s visszaadja az adott kocsi k�p infot.

post->images/insert

	Egy kocsi k�p info besz�r�sa.

delete->images/imageId

	Egy imageId alapj�n t�rli az adott kocsi k�p infot.

put->images/imageId

	Egy imageId alapj�n friss�ti az adatokat az adott kocsi k�p infon.


