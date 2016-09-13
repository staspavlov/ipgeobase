# IpGeoBase

Client for ipgeobase.ru geolocation webservice.

## Requirements

IpGeoBase depends on PHP 5.5+ and Guzzle 6+.

## Basic Usage

```php
use \GuzzleHttp\Client;
use \PSP\IpGeoBase\IpGeoBase;

$http = new Client();
$geo  = new IpGeoBase($http);

$response = $geo->request('144.206.192.6');

if ($response->getStatus()) {
    echo $response->getCity();
}
```

## License

Project code is licensed under the MIT License - see the LICENSE file for details.
