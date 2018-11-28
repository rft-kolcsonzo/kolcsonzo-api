# Images endpoint

[vissza](index.md)

## **GET** /images
Visszadja az összes kocsi kép infot.
	
```json
{
	"file_id": 5,
	"car_id": 3,
	"filename": "Király_lada.jpg",		
	"pathdir": "pics",
	"pathur": "file:///c://this/is/a/path/to/pics"
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

## **GET** /images/:fileId
Egy fileId-t vár és visszaadja az adott kocsi kép infot.

### Request
```json
{
	"fileId": 3
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

## **POST** /images/insert
Egy kocsi kép info beszúrása.

## **DELETE** /images/:fileId
Egy fileId alapján törli az adott kocsi kép infot.

## **PUT** /images/:fileId
Egy fileId alapján frissíti az adatokat az adott kocsi kép infon.

### request
```json
{
	"fileId": 5,
	"filename": "Öreg_opel.jpg"
}

### Response
```json
{
	"file_id": 5,
	"car_id": 3,
	"filename": "Öreg_opel",		
	"pathdir": "pics",
	"pathur": "file:///c://this/is/a/path/to/pics"
}
```

