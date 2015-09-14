<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
  return $app['twig']->render('pages/index.twig', ['config' => $app['config']]);
})
->bind('homepage');

$app->get('/usercp', function () use ($app) {
  return $app['twig']->render('pages/usercp/index.twig');
})->bind('usercp');

$app->get('/usercp/register', function () use ($app) {
  return $app['twig']->render('pages/usercp/register.twig');
})->bind('usercp_register');

$app->get('/usercp/login', function () use ($app) {
  return $app['twig']->render('pages/usercp/login.twig');
})->bind('usercp_login');

$app->get('/guildcp', function () use ($app) {
  return $app['twig']->render('pages/guildcp/index.twig');
})->bind('guildcp');

$app->get('/modcp', function () use ($app) {
  return $app['twig']->render('pages/modcp/index.twig');
})->bind('modcp');

$app->get('/admincp', function () use ($app) {
  return $app['twig']->render('pages/admincp/index.twig');
})->bind('admincp');

$app->get('/download', function () use ($app) {
  return $app['twig']->render('pages/download/index.twig');
})->bind('download');

$app->get('/chat', function () use ($app) {
  return $app['twig']->render('pages/chat/index.twig');
})->bind('chat');

$app->get('/forum', function () use ($app) {
  return $app['twig']->render('pages/forum/index.twig');
})->bind('forum');

$app->get('/presentation', function () use ($app) {
  return $app['twig']->render('pages/presentation.twig');
})->bind('presentation');

$app->get('/shop', function () use ($app) {
  return $app['twig']->render('pages/shop/index.twig');
})->bind('shop');

$app->get('/donate', function () use ($app) {
  return $app['twig']->render('pages/shop/donate.twig');
})->bind('donate');

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
