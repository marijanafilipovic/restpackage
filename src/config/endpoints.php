<?php
return [
    'a list of the available countries' => '/countries',
    'get a specific country' => '/countries/:id',
    'get the card info' => '/cards/:id',
    'gets the balance of the card' => '/cards/:id/balance',
    'gets the pin code of the card' => '/cards/:id/pin',
    'get a list of transaction history, expects a timeframe' => '/cards/:id/history',
    'creates a new debit card' => '/cards/create',
    'deactivates a card'=> '/cards/:id/deactivate',
    'activates a card' => '/cards/:id/activate',
    'updates the pin of the card' => '/cards/:id/update',
    'loads card with a balance, expects to get the amount to load as a parameter' => '/cards/:id/load'
];
