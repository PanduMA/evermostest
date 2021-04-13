How to run api?
<br/>
API CREATE ORDER <br/>
url : http://localhost/evermos/api/order/create.php
<br/>
method : POST<br/>
Request :<br/>
```json
{
    "productid" : "16",
    "userid" : "132",
    "unit_order" : "2",
    "notes" : "test create order",
    "price_condition": "normal",
    "payment_method" : "bank",
    "created_at" : "2021-04-09 20:30:14"
}
```
Response :<br/>
```json
{
    "message" : "Succes create new order"
}
```
<br/>
<br/>
How to run game?
<br/>
Open command prompt located to directory game/ <br/>
type php game.php
<br/>
After program show, enter key for move position and then enter<br/>
