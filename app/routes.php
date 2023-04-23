<?php

return [

    ['get', '/', 'Index', 'index'],

    // PCRE syntax
    ['get', '^/argument/(?<id>[1-9]\d*)/(?<name>\w+)$', 'Index', 'argumentValidated'],

    ['get', '/auth', 'Auth', 'index'],
    ['post', '/auth/connect', 'Auth', 'login'],
    ['post', '/auth/disconnect', 'Auth', 'logout'],

    ['get', '/auth/signin', 'Auth', 'register'],
    ['post', '/auth/register', 'Auth', 'register'],

    ['get', '/auth/forgot-password', 'Auth', 'forgotPassword'],
    ['post', '/auth/request-reset-password', 'Auth', 'forgotPassword'],

    ['get', '/auth/reset-password', 'Auth', 'resetPassword'],
    ['post', '/auth/request-reset-password', 'Auth', 'resetPassword'],

];
