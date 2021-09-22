<?php
return [
   'client_id' => env('PAYPAL_CLIENT_ID','AcIDuyNN65rkzQPMdTHg-iDY6fZiNS1e8j97Bst6jud9AeEx-yAxB1aO4rML-Qv9un0GCJ7VuLiLpQVS'),
   'secret' => env('PAYPAL_SECRET','EL8sO7AfnyHK1HwmUR8gZ4wxyIWZHP-Z7Rt5geqJGlU_7E6vfIxfj57MDAEijx6NIY4my7VsNSUUkZDc'),
   'settings' => array(
       'mode' => env('PAYPAL_MODE','sandbox'),
       'http.ConnectionTimeOut' => 30,
       'log.LogEnabled' => true,
       'log.FileName' => storage_path() . '/logs/paypal.log',
       'log.LogLevel' => 'ERROR'
   ),
];
