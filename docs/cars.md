# Cars endpoint

[vissza](index.md)

## **GET** /cars
Visszadja az összes kocsit.
	
### Response
```json
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
```

## **GET** /cars/filter
Egy **field** és egy **keyword** paramétert vár.
* *field*: 
	* melyik mező alapján akarsz lekérdezni,
* *keyword*: 
	* milyen értékkel.

### Request
```json
{
	"persons": 4
}
```
### Response
```json
{
	"car_id": 1,	
	"modell": "model_nev",	
	"type": "tipus",	
	"factory_id": "gyartasi_szam",	
	"persons": 4,	
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
```

## **GET** /cars/:carId
Egy carId-t vár és visszaadja az adott kocsit.

### Request
```json
{
	"carId": 1
}
```

### Response
```json
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
```

## **POST** cars/insert
Egy kocsi beszúrása.

## **DELETE** cars/:carId
Egy carId alapján törli az adott kocsit.

## **PUT** cars/:carId
Egy carId alapján frissíti az adatokat az adott kocsin.

### Request
```json
{
	"carId": 2,
	"color": "kék"
}
```

### Response
```json
{
	"car_id": 1,	
	"modell": "model_nev",	
	"type": "tipus",	
	"factory_id": "gyartasi_szam",	
	"persons": 2,	
	"doors_number": 4,	
	"category": "kategoria",	
	"tags": "tag",	
	"color": "kék",
	"born_date": "2018-01-02",	
	"insurance_name": "biztositas neve",	
	"insurance_id": "biztositas szama",	
	"insurance_until_date": "2020-11-02",
	"car_status_details": "A kocsirol egy leiras, hogy mi is van vele.",	
	"available_status": 1
}
```



