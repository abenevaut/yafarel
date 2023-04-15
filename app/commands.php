<?php

return [
    'about' => [
        'type' => 'rewrite',
        'match' => '/cli/about/index',
        'route' => [
            'module' => 'Cli',
            'controller' => 'about',
            'action' => 'index',
        ],
    ],
];
