<?php

require_once __DIR__.'/backend/hack.php';

$app->get('/', function() use($app) {
  return $app['twig']->render('pages/landpage.twig');
})->bind('cms_landpage');

$app->get('/home', function() use($app) {
  return $app['twig']->render('pages/home.twig');
})->bind('cms_home');

$app->run();
