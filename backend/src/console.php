<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use GitWrapper\GitWrapper;

$cmsinfo = [
  'repository' => rtrim(file_get_contents(__DIR__.'/../safelocker/release')),
  'version' => rtrim(file_get_contents(__DIR__.'/../safelocker/hacktor/release.log')),
];

$console = new Application('Metin2CMS', sprintf('%s::%s', $cmsinfo['repository'], $cmsinfo['version']));
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);

$console
  ->register('m2:ranking')
  ->setDefinition(array(
    // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
  ))
  ->setDescription('Metin2 rankings.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    // do something

  });
$console
  ->register('repo:update')
  ->setDefinition(array(
    new InputOption('message', 'm', InputOption::VALUE_REQUIRED, 'Git commit message'),
  ))
  ->setDescription('Send changes to GitHub repository')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $message = ($input->getOption('message')) ? $input->getOption('message') : 'Repository update from Metin2CMS CLI.';
    $wrapper = new GitWrapper();
    $wrapper->setTimeout(3600);
    $git = $wrapper->workingCopy(CMS_ROOT);
    $git->add('*')->commit($message)->push();

    $output->writeIn($wrapper->streamOutput());
  });
return $console;
