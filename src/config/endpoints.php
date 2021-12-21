<?php
return [
    'country'=>[
        'get'=>[
            'a list of the available countries' => '/countries',
            'get a specific country' => '/countries/:id',
        ],
        'post'=>[]
    ],
    'card' =>[
        'get'=> [
            'country list' => 'https://countriesnow.space/api/v0.1/countries',
             'get the card info' => '/cards/:id',
            'gets the balance of the card' => '/cards/:id/balance',
            'gets the pin code of the card' => '/cards/:id/pin',
            'get a list of transaction history, expects a timeframe' => '/cards/:id/history'],
        'post' => [
            'creates a new debit card' => '/cards/create',
            'deactivates a card'=> '/cards/:id/deactivate',
            'activates a card' => '/cards/:id/activate',
            'updates the pin of the card' => '/cards/:id/update',
            'loads card with a balance, expects to get the amount to load as a parameter' => '/cards/:id/load'
        ]
    ],


];
