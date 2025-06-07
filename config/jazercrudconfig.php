<?php

return [
    /** Project Configurations */
    'project_refid'                 => env('PROJECT_REFID', ''),


    /** Database Connection Configurations */
    'conn_crud_ip'                 => env('CONN_crud_IP', env('DB_HOST')),
    'conn_crud_pt'                 => env('CONN_crud_PT', env('DB_PORT')),
    'conn_crud_db'                 => env('CONN_crud_DB', env('DB_DATABASE')),
    'conn_crud_un'                 => env('CONN_crud_UN', env('DB_USERNAME')),
    'conn_crud_pw'                 => env('CONN_crud_PW', env('DB_PASSWORD')),

    /** Query parameters */
    'fetch_paginate_max'            => env('FETCH_PAGINATE_MAX', 25),
];
