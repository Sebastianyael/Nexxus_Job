<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    // Agregamos '*' al final para asegurar que cualquier ruta de la API sea capturada
    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'],

    'allowed_methods' => ['*'],

    // Asegúrate de que estas URLs no tengan una "/" al final
    'allowed_origins' => [
        '*'
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Al no usar Sanctum, es mejor dejarlo en false para evitar conflictos con Axios
    'supports_credentials' => false,

];