<?php

return [
    'GET' => [
        '' => ['TaskController', 'index'],
        // TODO: 'tasks/create' => ['TaskController', 'create'],
        // TODO: 'tasks/update' => ['TaskController', 'edit', ['taskId']],
        'login' => ['AuthController', 'index'],
    ],
    'POST' => [
        // TODO: 'tasks/create' => ['TaskController', 'store'],
        // TODO: 'tasks/update' => ['TaskController', 'update', ['taskId']],
        'login' => ['AuthController', 'login'],
        'logout' => ['AuthController', 'logout'],
    ],
];
