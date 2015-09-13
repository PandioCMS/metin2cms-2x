<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Igorw\Silex\ConfigServiceProvider;
use Silex\Provider\FormServiceProvider;

define('__cms_root__', dirname(dirname(__DIR__)).'/');

$lcpdeflist = [
  'htdocs' => __cms_root__.'public_html',
  'config' => __cms_root__.'backend/config',
  'safelocker' => __cms_root__.'backend/safelocker',
  'source' => __cms_root__.'backend/src',
  'templates' => __cms_root__.'backend/templates',
  'library' => __cms_root__.'backend/vendor'
];

foreach ($lcpdeflist as $name => $path) {
  if (!file_exists($path)) {
    exit;
  }

  define (sprintf('__cms_%s__', $name), $path);
}

require_once __cms_library__.'/autoload.php';

$app = new Application();
$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new ConfigServiceProvider(__cms_config__.'/cms.php'));

$app['twig'] = $app->extend('twig', function ($twig, $app) {
  // add custom globals, filters, tags, ...

  $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
    return $app['request_stack']->getMasterRequest()->getBasepath().'/'.ltrim($asset, '/');
  }));

  return $twig;
});

$data = explode('::', rtrim(file_get_contents(__cms_safelocker__.'/hacktor/release.log')));
$app['poweredBy'] = sprintf('Powered by Metin2CMS v%s (%s)', $data[1], $data[0]);
unset($data);

return $app;
