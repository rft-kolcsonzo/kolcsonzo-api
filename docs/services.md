# Services endpoint

[vissza](index.md)

## **GET** /services
Visszadja az összes szerviz infot.
	
### Response
```json
{
	"service_id": 2,	
	"car_id": 3,	
	"service_date": "2018-12-03",	
	"runned_km": 200,	
	"need_to_fix": 0,	
	"ready_to_work": 0
}
```

## **POST** /services
Egy szerviz info beszúrása.

### Request
```json
{
	"service_id": 2,	
	"car_id": 3,	
	"service_date": "2018-12-03",	
	"runned_km": 200,	
	"need_to_fix": 0,	
	"ready_to_work": 0
}
```

### Response
```json
{
    "message": "1"
}
```

## **GET** /services/:carId
Egy carId-t vár és visszaadja az adott szerviz infot.

### Request
```json
{
	"carId": 1
}
```

### Response
```json
{
	"service_id": 1,	
	"car_id": 3,	
	"service_date": "2018-12-03",	
	"runned_km": 200,	
	"need_to_fix": 0,	
	"ready_to_work": 0
}
```

## **PUT** /services/:carId
Egy carId alapján frissíti az adatokat az adott szerviz infon.

### Request
```json
{
	"service_id": 2,	
	"car_id": 3,	
	"service_date": "2018-12-03",	
	"runned_km": 200,	
	"need_to_fix": 0,	
	"ready_to_work": 0
}
```

### Response
```json
{
    "message": 1
}
```

## **DELETE** /services/:carId
Egy carId alapján törli az adott szerviz infot.

### Response
```json
{
    "message": "Sikeres törlés"
}
```

## **GET** /services/filter
Egy **field** és egy **keyword** paramétert vár.
* *field*: 
	* melyik mező alapján akarsz lekérdezni,
* *keyword*: 
	* milyen értékkel.

### Request
```json
{
	"runned_km": 400
}
```
### Response
```json
{
	"service_id": 2,	
	"car_id": 3,	
	"service_date": "2018-12-03",	
	"runned_km": 400,	
	"need_to_fix": 0,	
	"ready_to_work": 0
}
```



