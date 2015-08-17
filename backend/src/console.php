<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use GitWrapper\GitWrapper;

$console = new Application('Metin2CMS', rtrim(file_get_contents(CMS_SAFELOCKER.'/hacktor/release.log')));
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);

$console
  ->register('repo:version')
  ->setDefinition(array(
    new InputOption('source', 's', InputOption::VALUE_REQUIRED, 'The source from where version is displayed. Defaults to cache.'),
  ))
  ->setDescription('Display Metin2CMS version.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $source = $input->getOption('source');
    if ($source == 'git') {
      $repository = rtrim(file_get_contents(CMS_SAFELOCKER.'/release'));

      $wrapper = new GitWrapper();
      $wrapper->setTimeout(3600);
      $git = $wrapper->workingCopy(CMS_ROOT);

      if ($repository == 'nightly') {
        $version = ltrim($wrapper->git('rev-parse --short HEAD'));
      } else if($repository == 'stable') {
        $version = ltrim($wrapper->git('describe --exact-match --abbrev=0'));
      } else {
        $version = 'unknown';
      }
    } else if ($source == 'cache') {
      $data = explode('::', rtrim(file_get_contents(CMS_SAFELOCKER.'/hacktor/release.log')));
      $version = $data[1];
    } else {
      $data = explode('::', rtrim(file_get_contents(CMS_SAFELOCKER.'/hacktor/release.log')));
      $version = $data[1];
      $source = 'cache';
    }

    $output->writeln(sprintf('Metin2CMS <info>(%s)</info> version <comment>%s</comment>', ucfirst($source), $version));
  });
$console
  ->register('repo:push')
  ->setDefinition(array(
    new InputOption('message', 'm', InputOption::VALUE_REQUIRED, 'Git commit message'),
  ))
  ->setDescription('Send changes to Git repository.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $cmsinfo = [
      'repository' => rtrim(file_get_contents(CMS_SAFELOCKER.'/release')),
      'version' => CMS_SAFELOCKER.'/hacktor/release.log',
      'history' => CMS_SAFELOCKER.'/hacktor/changes.log',
    ];

    $message = ($input->getOption('message')) ? $input->getOption('message') : 'Repository update from Metin2CMS CLI.';
    $wrapper = new GitWrapper();
    $wrapper->setTimeout(3600);
    $git = $wrapper->workingCopy(CMS_ROOT);
    $git->config('push.default', 'matching');
    if ($git->hasChanges()) {
      $git->add('*')->commit($message)->push();
      $output->writeln("<info>Repository update complete.</info>\nNew Commit: <comment>%s</comment>", $wrapper->git('rev-parse HEAD'));
    } else {
      $output->writeln('No changes to commit.');
    }

    if ($cmsinfo['repository'] == 'nightly') {
      $version = $wrapper->git('rev-parse --short HEAD');
    } else if($cmsinfo['repository'] == 'stable') {
      $version = $wrapper->git('describe --exact-match --abbrev=0');
    } else {
      $version = 'unknown';
    }

    $fs = new Filesystem();

    if ($fs->exists($cmsinfo['version'])) {
      file_put_contents($cmsinfo['version'], sprintf('%s::%s', $cmsinfo['repository'], $version));
    } else {
      $fs->touch($cmsinfo['version']);
      file_put_contents($cmsinfo['version'], sprintf('%s::%s', $cmsinfo['repository'], $version));
    }

    if ($fs->exists($cmsinfo['history'])) {
      file_put_contents($cmsinfo['history'], $wrapper->git('log'));
    } else {
      $fs->touch($cmsinfo['history']);
      file_put_contents($cmsinfo['history'], $wrapper->git('log'));
    }
  });
$console
  ->register('repo:pull')
  ->setDescription('Fetch changes from remote Git repository.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $wrapper = new GitWrapper();
    $wrapper->setTimeout(3600);
    $git = $wrapper->workingCopy(CMS_ROOT);

    $git->fetchAll();
    $output->writeln('<info>Fetched all repositories from remote.</info>');
  });
return $console;
