<?php

use Symfony\Component\Debug\Debug;

// Add here your IP if you want to access the debug front controller on production servers.
$allowed_ips = [
  // localhost IPs, don't edit!
  '127.0.0.1',
  'fe80::1',
  '::1',
  // add your IP here
  '2a01:e35:3985:85b0:c9ef:6d35:295e:33a9',
  '83.152.88.91',
];

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], $allowed_ips)
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file.');
}

require_once __DIR__.'/../backend/vendor/autoload.php';

Debug::enable();

$app = require __DIR__.'/../backend/src/app.php';
require __DIR__.'/../backend/config/dev.php';
require __DIR__.'/../backend/src/controllers.php';
$app->run();
