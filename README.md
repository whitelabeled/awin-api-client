# Awin API client

[![Latest Stable Version](https://img.shields.io/packagist/v/whitelabeled/awin-api-client.svg)](https://packagist.org/packages/whitelabeled/awin-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/whitelabeled/awin-api-client.svg)](https://packagist.org/packages/whitelabeled/awin-api-client)
[![License](https://img.shields.io/packagist/l/whitelabeled/awin-api-client.svg)](https://packagist.org/packages/whitelabeled/awin-api-client)

Library to retrieve sales from the Awin publisher API.

Usage:

```php
<?php
require 'vendor/autoload.php';

$publisher = 12345678;
$token = 'authtoken';

$client = new \whitelabeled\AwinApi\AwinClient($token, $publisher);
``` 

## Example data

```
Array
(
    [0] => whitelabeled\AwinApi\Transaction Object
        (
            [id] => 193452706
            [transactionDate] => DateTime Object
                (
                    [date] => 2017-09-09 01:14:00.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Berlin
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2017-09-08 18:58:00.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Berlin
                )

            [validationDate] => 
            [advertiserId] => 8389
            [clickDevice] => iPhone
            [transactionDevice] => Android Mobile
            [commissionStatus] => pending
            [declineReason] => 
            [clickRefs] => Array
                (
                    [clickRef6] => http://www.example.com/example
                )

            [commissionAmount] => 50
            [totalCommissionAmount] => 50
            [sharedCommission] => 
            [commissionPercentage] => 100
            [orderReference] => 
            [saleAmount] => 694.21
            [siteName] => http://www.example.com/
            [url] => 
            [paid] => 
            [transactionParts] => Array
                (
                    [0] => whitelabeled\AwinApi\TransactionPart Object
                        (
                            [commissionGroupId] => 134159
                            [commissionGroup] => 
                            [amount] => 694.21
                            [commissionAmount] => 50
                        )

                )

            [transactionType] => Commission group transaction
        )

    [1] => whitelabeled\AwinApi\Transaction Object
        (
            [id] => 193450524
            [transactionDate] => DateTime Object
                (
                    [date] => 2017-09-12 02:04:00.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Berlin
                )

            [clickDate] => DateTime Object
                (
                    [date] => 2017-09-11 17:52:00.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Berlin
                )

            [validationDate] => 
            [advertiserId] => 8313
            [clickDevice] => iPhone
            [transactionDevice] => iPhone
            [commissionStatus] => pending
            [declineReason] => 
            [clickRefs] => Array
                (
                    [clickRef] => 
                    [clickRef2] => ex_80909
                    [clickRef3] => www.example.net
                )

            [commissionAmount] => 12.5
            [totalCommissionAmount] => 25
            [sharedCommission] => 1
            [commissionPercentage] => 50
            [orderReference] => 
            [saleAmount] => 13
            [siteName] => http://www.example.com
            [url] => http://www.example.com/
            [paid] => 
            [transactionParts] => Array
                (
                    [0] => whitelabeled\AwinApi\TransactionPart Object
                        (
                            [commissionGroupId] => 136539
                            [commissionGroup] => 
                            [amount] => 13
                            [commissionAmount] => 25
                        )

                )

            [transactionType] => Commission group transaction
        )

)
```

## License

© Vergelijkgroep BV

MIT license, see [LICENSE.txt](LICENSE.txt) for details.