

get->images

	Visszadja az összes kocsi kép infot.
	
	Pl:
	{
		"file_id": 5,
		"car_id": 3,
		"filename": "Király lada.jpg",
		"pathdir": "pics",
		"pathur": "file:///c://this/is/a/path/to/pics"
	}

get->images/filter
	
	Egy 'field' és egy 'keyword' paramétert vár.
	field: melyik mezõ alapján akarsz lekérdezni,
	keyword: milyen értékkel.

get->images/imageId

	Egy imageId-t vár és visszaadja az adott kocsi kép infot.

post->images/insert

	Egy kocsi kép info beszúrása.

delete->images/imageId

	Egy imageId alapján törli az adott kocsi kép infot.

put->images/imageId

	Egy imageId alapján frissíti az adatokat az adott kocsi kép infon.


