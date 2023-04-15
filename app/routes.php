<?php

return [
    ['get', '/', 'Index', 'index'],
    ['get', '/auth', 'Auth', 'index'],
    ['post', '/auth/login', 'Auth', 'login'],
    ['post', '/auth/logout', 'Auth', 'logout'],
    ['post', '/auth/register', 'Auth', 'register'],
    ['post', '/auth/forgot-password', 'Auth', 'forgotPassword'],
    ['post', '/auth/reset-password', 'Auth', 'resetPassword'],
];
