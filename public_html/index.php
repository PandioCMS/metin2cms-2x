<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../backend/vendor/autoload.php';

$app = require __DIR__.'/../backend/src/app.php';
require __DIR__.'/../backend/config/prod.php';
require __DIR__.'/../backend/src/controllers.php';
$app->run();
