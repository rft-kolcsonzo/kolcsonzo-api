<h1>Orders endpoint</h1>

<p>get->orders</p>

<pre>
Visszadja az összes rendelést.
Pl:
{
    "message": {
        "rent_id": 2,
        "car_id": 122,
        "start_date": "2018-11-02 00:00:00",
        "end_date": "2018-11-18 00:00:00",
        "rent_status": 1,
        "starting_km": 122000,
        "last_km": 128000,
        "accident_details": "nincs",
        "daily_rent_price": 5000,
        "fixing_price": 0,
        "insurance_price": 1235,
        "deposit": 20000,
        "rent_subtotal": 350000,
        "vat": 20000,
        "rent_total": 200000,
        "firstname": "Nagy",
        "lastname": "János",
        "user_id": 1,
        "email": "valami@valami.hu",
        "address": "sdfsdfsdf",
        "phone": "12345678",
        "birthdate": "1976-01-07",
        "is_order_deleted": 1
    }
}</pre>

<p>get->/active_orders</p>
<pre>A folyamatban lévő rendeléseket adja vissza.</pre>

<p>get->/closed_orders</p>
<pre>A lezárt/teljesített rendeléseket adja vissza.</pre>

<p>get->/startperiod</p>
<pre> Azokat a rendeléseket adja vissza, amely bérlések kezdete a paraméterek közötti intervallumban van.
Két paramétert vár:
- startdate: az intervallum kezdő értékét
- enddate: az intervallum záró értékét
A dátumformátum: YYYY-MM-DD
</pre>

<p>get->/endperiod</p>
<pre> Azokat a rendeléseket adja vissza, amely bérlések vége a paraméterek közötti intervallumban van.
Két paramétert vár:
- startdate: az intervallum kezdő értékét
- enddate: az intervallum záró értékét
A dátumformátum: YYYY-MM-DD
</pre>

<p>get->/cars</p>
<pre>Lehetőség van autó paraméter alapján keresni a rendelések között. A filter metódushoz hasonlóan működik, két paramétert vár:
Keyword: az autó vizsgálandó mezője
Value: az autó mezőjének értéke
pl keyword: modell, value: 'Alfa Rómeó'
Visszadja azokat a rendeléseket, ahol Alfa Rómeót vettek bérbe.
</pre>

<p>get->orders/filter</p>
<pre>Egy 'field' és egy 'keyword' paramétert vár.
field: melyik mező alapján akarsz lekérdezni,
keyword: milyen értékkel.
Ez alapján megvalósítható a felhasználó ID vagy az autó ID szerinti keresés is.</pre>

<p>get->orders/orderId</p>
<pre>Egy orderId-t vár és visszaadja az adott rendelést.</pre>

<p>post->orders/insert</p>
<pre>Egy kocsi beszúrása.</pre>

<p>delete->orders/orderId</p>
<pre>Egy orderId alapján törli az adott kocsit.</pre>

<p>put->orders/orderId</p>
<pre>Egy orderId alapján frissíti az adatokat az adott kocsin.</pre>



