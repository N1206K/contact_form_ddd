<?php

return [
    '/' => [
        'controller' => 'CustomerController',
        'action' => 'index'
    ],
    '/{confirm}' => [
        'controller' => 'CustomerController',
        'action' => 'confirm'
    ],
];
