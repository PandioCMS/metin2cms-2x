<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use GitWrapper\GitWrapper;
use GitWrapper\GitException;

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
    try {
      $message = ($input->getOption('message')) ? $input->getOption('message') : 'Repository update from Metin2CMS CLI.';

      $wrapper = new GitWrapper();
      $wrapper->setTimeout(3600);
      $git = $wrapper->workingCopy(CMS_ROOT);
      $git->config('push.default', 'matching');
      $git->add('*')->commit($message)->push();

      $output->writeIn($wrapper->streamOutput());

      $repoType = file_get_contents(CMS_SAFELOCKER.'/release');

      if ($repoType == 'nightly') {
        $version = $wrapper->git('rev-parse --short HEAD');
      } else if($repoType == 'stable') {
        $version = $wrapper->git('describe --exact-match --abbrev=0');
      } else {
        $version = 'unknown';
      }

      try {
        $fs = new Filesystem();
        $logFile = CMS_SAFELOCKER.'/hacktor/release.log';
        if ($fs->exists($logFile)) {
          file_put_contents($logFile, sprintf('%s::%s', $repoType, $version));
        } else {
          $fs->touch($logFile);
          file_put_contents($logFile, sprintf('%s::%s', $repoType, $version));
        }
      } catch (IOExceptionInterface $e) {
        $output->writeIn(sprintf('<error>Caught IOExceptionInterface: %s</error>', $e->getMessage()));
      }

    } catch (GitException $e) {
      $output->writeIn(sprintf('<error>Caught GitException: %s</error>', $e->getMessage()));
    }
  });
return $console;
