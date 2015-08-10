<?php

require_once __DIR__.'/backend/hack.php';

$app->get('/', function() use($app, $git) {
  if ($app['session']->has('home')) {
    return $app['twig']->render('pages/home.twig', ['version' => $git->getVersion()]);
  } else {
    return $app->redirect($app['url_generator']->generate('cms_setsession'));
  }
})->bind('cms_landpage');

$app->get('/setsession', function() use ($app) {
  if ($app['session']->has('home')) {
    return $app->redirect($app['url_generator']->generate('cms_landpage'));
  } else {
    $app['session']->set('home', true);
    return $app->redirect($app['url_generator']->generate('cms_landpage'));
  }
})->bind('cms_setsession');

$app->run();
