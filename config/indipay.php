<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Indipay Service Config
    |--------------------------------------------------------------------------
    |   gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / Mocker
    |   view    = File
    */

    'gateway' => 'CCAvenue',                // Replace with the name of default gateway you want to use

    'testMode'  => true,                   // True for Testing the Gateway [For production false]

    'ccavenue' => [                         // CCAvenue Parameters
    'merchantId'  => env('INDIPAY_MERCHANT_ID', '174058'),
    'accessCode'  => env('INDIPAY_ACCESS_CODE', 'AVKW01FD73BY50WKYB'),
    'workingKey' => env('INDIPAY_WORKING_KEY', '54716DD0D240E1021F673D88F6C201B8'),

        // Should be route address for url() function
    'redirectUrl' => env('INDIPAY_REDIRECT_URL', 'ccavenue/response'),
    'cancelUrl' => env('INDIPAY_CANCEL_URL', 'ccavenue/response'),

    'currency' => env('INDIPAY_CURRENCY', 'INR'),
    'language' => env('INDIPAY_LANGUAGE', 'EN'),
    ],

    'payumoney' => [                         // PayUMoney Parameters
    'merchantKey'  => env('INDIPAY_MERCHANT_KEY', ''),
    'salt'  => env('INDIPAY_SALT', ''),
    'workingKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
    'successUrl' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
    'failureUrl' => env('INDIPAY_FAILURE_URL', 'indipay/response'),
    ],

    'ebs' => [                         // EBS Parameters
    'account_id'  => env('INDIPAY_MERCHANT_ID', ''),
    'secretKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
    'return_url' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
    ],

    'citrus' => [                         // Citrus Parameters
    'vanityUrl'  => env('INDIPAY_CITRUS_VANITY_URL', ''),
    'secretKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
    'returnUrl' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
    'notifyUrl' => env('INDIPAY_SUCCESS_URL', 'indipay/response'),
    ],

    'instamojo' =>  [
    'api_key' => env('INSTAMOJO_API_KEY',''),
    'auth_token' => env('INSTAMOJO_AUTH_TOKEN',''),
    'redirectUrl' => env('INDIPAY_REDIRECT_URL', 'indipay/response'),
    ],

    'mocker' =>  [
    'service' => env('MOCKER_SERVICE','default'),
    'redirect_url' => env('MOCKER_REDIRECT_URL', 'indipay/response'),
    ],

    // Add your response link here. In Laravel 5.2 you may use the api middleware instead of this.
    'remove_csrf_check' => [
    'indipay/response'
    ],





    ];
