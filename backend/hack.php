<?php

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__.'/app/db.php';
require_once __DIR__.'/functions/metin2.php';
require_once __DIR__.'/functions/internal.php';

if (getenv('HTTP_HOST') == 'app.metin2cms-dev.zz.mu') {
  $app['debug'] = true;
  define ('CMS_WIP', true);
  error_reporting(E_ALL);
} else {
  error_reporting(0);
}

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), [
  'monolog.logfile' => __DIR__.'/safelocker/logs/hacktor.log',
  'monolog.level' => defined('CMS_WIP') && CMS_WIP ? 'DEBUG' : 'INFO',
  'monolog.name' => 'hacktor',
]);

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
  'db.options' => [
      'driver'    => 'pdo_mysql',
      'host'      => $db['hostname'],
      'dbname'    => $db['database'],
      'user'      => $db['username'],
      'password'  => $db['password'],
      'charset'   => $db['xcharset'],
  ],
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
  'twig.path' => __DIR__.'/template',
  'twig.options' => [
    'cache' => defined('CMS_WIP') && CMS_WIP ? false : __DIR__.'/safelocker/twig',
  ],
]);

$app->register(new Silex\Provider\SessionServiceProvider(), [
  'session.storage.save_path' => __DIR__.'/safelocker/sessions',
  'session.storage.options' => [
    'name' => 'rockinpeace',
    'id' => md5('hackmylife'),
    'cookie_lifetime' => 3600*6,
    'cookie_path' => '/',
    'cookie_domain' => 'app.metin2cms-dev.zz.mu',
    'cookie_secure' => false,
    'cookie_httponly' => true,
  ],
]);

$app->register(new Silex\Provider\FormServiceProvider());