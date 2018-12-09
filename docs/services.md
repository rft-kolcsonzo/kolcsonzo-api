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

## **GET** /services/:serviceId
Egy serviceId-t vár és visszaadja az adott szerviz infot.

### Request
```json
{
	"serviceId": 1
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

## **PUT** /services/:serviceId
Egy serviceId alapján frissíti az adatokat az adott szerviz infon.

## **DELETE** /services/:serviceId
Egy serviceId alapján törli az adott szerviz infot.

### Request
```json
{
	"serviceId": 2,
	"ready_to_work": 1
}
```

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



