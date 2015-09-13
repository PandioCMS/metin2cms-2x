<?php

// configure your app for the production environment

$app['twig.path'] = [
  sprintf('%s/%s', __cms_templates__, $app['config']['site']['template'])
];

$app['twig.options'] = [
  'cache' => __cms_safelocker__.'/twig'
];
