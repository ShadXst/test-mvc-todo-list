<?php

return [
    'GET' => [
        '' => ['TaskController', 'index'],
        'tasks/create' => ['TaskController', 'create'],
        'tasks/update' => ['TaskController', 'edit', ['taskId']],
        'login' => ['AuthController', 'index'],
    ],
    'POST' => [
        'tasks/create' => ['TaskController', 'store'],
        'tasks/update' => ['TaskController', 'update', ['taskId']],
        'login' => ['AuthController', 'login'],
        'logout' => ['AuthController', 'logout'],
    ],
];
