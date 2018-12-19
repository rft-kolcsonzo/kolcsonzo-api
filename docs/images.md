# Images endpoint

[vissza](index.md)

## **GET** /images
Visszadja az összes kocsi kép infot.
	
### Response
```json
{
	"file_id": 5,
	"car_id": 3,
	"filename": "Király_lada.jpg",		
	"pathdir": "pics",
	"pathur": "file:///c://this/is/a/path/to/pics"
}
```

## **POST** /images
Egy kocsi kép info beszúrása.

### Request
```json
{
	"file_id": 5,
	"car_id": 3,
	"filename": "Király_lada.jpg",		
	"pathdir": "pics",
	"pathur": "file:///c://this/is/a/path/to/pics"
}

### Response
```json
{
    "message": "1"
}
```

## **GET** /images/:carId
Egy carId-t vár és visszaadja az adott kocsi id-hoz tartó kép infót.

### Request
```json
{
	"carId": 3
}
```
### Response
```json
{
	"file_id": 5,
	"car_id": 3,
	"filename": "Király_lada.jpg",		
	"pathdir": "pics",
	"pathur": "file:///c://this/is/a/path/to/pics"
}
```

## **PUT** /images/:carId
Egy carId alapján frissíti az adatokat az adott kocsi kép infon.

### Request
```json
{
    "message": 1
}
```

### Response
```json
{
    "message": "5"
}
```

## **DELETE** /images/:carId
Egy carId alapján törli az adott kocsi kép infot.

### Response
```json
{
    "message": "Sikeres törlés"
}
```

## **GET** /images/filter
Egy **field** és egy **keyword** paramétert vár.
* *field*: 
	* melyik mező alapján akarsz lekérdezni,
* *keyword*: 
	* milyen értékkel.

### Request
```json
{
	"filename": "Király_lada.jpg"
}
```
### Response
```json
{
	"file_id": 5,
	"car_id": 3,
	"filename": "Király_lada.jpg",		
	"pathdir": "pics",
	"pathur": "file:///c://this/is/a/path/to/pics"
}
```

