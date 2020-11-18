<?php
/**
 * Конфигурация роутера
 * @return array "запрос"=>["Класс" => "Класс", "метод"=>"метод"]
 */
return [
    'request_from_client_1' => [
        'controller_class' => 'AgesTable',
        'action' => 'maxAgeList'
    ],
    'request_from_client_2' => [
        'controller_class' => 'AgesTable',
        'action' => 'allTable'
    ],
    'request_from_client_3' => [
        'controller_class' => 'AgesTable',
        'action' => 'maxAge'
    ],
    'request_from_client_4' => [
        'controller_class' => 'AgesTable',
        'action' => 'UpdateOne'
    ]
];