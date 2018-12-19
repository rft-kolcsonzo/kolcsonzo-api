# Cars endpoint

[vissza](index.md)

## **GET** /cars
Visszadja az összes kocsit kiegészítve, hogy a biztosítás érvényes-e vagy sem.(*insurance_status*)

	
### Response
```json
{
	"car_id": 1,	
	"plate_number": "asd324",	
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
	"available_status": 1,
	"insurance_status": true
}
```

## **POST** /cars
Egy kocsi beszúrása.

### Request
```json
{
	"car_id": 2,	
	"plate_number": "asd324",	
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

### Response
```json
{
    "message": "1"
}
```

## **GET** /cars/:carId
Egy carId-t vár és visszaadja az adott kocsit kiegészítve, hogy a biztosítás érvényes-e vagy sem.(*insurance_status*)

### Response
```json
{
	"car_id": 1,	
	"plate_number": "asd324",	
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
	"available_status": 1,
	"insurance_status": true
}
```

## **PUT** cars/:carId
Egy carId alapján frissíti az adatokat az adott kocsin.

### Request
```json
{
    "message": 1
}
```

## **DELETE** cars/:carId
Egy carId alapján törli az adott kocsit.


### Response
```json
{
    "message": "Sikeres törlés"
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
	"plate_number": "asd-324",		
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
	"available_status": 1,
	"insurance_status": true
}
```



