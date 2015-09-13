<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
  return $app['twig']->render('pages/index.twig');
})
->bind('homepage');

$app->get('/profile', function () use ($app) {
  return $app->redirect('/');
});

$app->get('/server', function () use ($app) {
  #return $app['serverName'];
  return $app['twig']->render('server.twig', ['config' => $app['config']]);
});

$app->get('/profile/{name}', function ($name) use ($app) {
  return $app['twig']->render('pages/profile.twig', ['name' => $name]);
})->bind('profile');

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
  if ($app['debug']) {
    return;
  }

  // 404.html, or 40x.html, or 4xx.html, or error.html
  $templates = [
    sprintf('errors/%s.twig', $code),
    sprintf('errors/%sx.twig', substr($code, 0, 2)),
    sprintf('errors/%sxx.twig', substr($code, 0, 1)),
    'errors/default.twig',
  ];

  return new Response($app['twig']->resolveTemplate($templates)->render(['code' => $code], $code));
});
