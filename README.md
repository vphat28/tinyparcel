##Installation

The server/api part can be run with builtin PHP server using
```
php -S 0.0.0.0:8000 -t public
```
Copy the .env.sample file to .env and edit your mysql connection

#Testing

The phpunit.xml is provided and unit tests can be run from the root folder by simply 
```
phpunit
```

#Authentication

The hardcoded bearer token is `somethinggood`. This is a sample request using postman
```
curl --location --request POST 'http://51.79.158.147:8000/parcels' \
--header 'Authorization: Bearer somethinggood' \
--header 'Content-Type: application/json' \
--data-raw '{
    "item_name": "New smartphone",
    "weight": 5.1,
    "volume": 0.0003,
    "declared_value": 4
}'
```
