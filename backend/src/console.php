<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use GitWrapper\GitWrapper;

$cmsinfo = [
  'repository' => rtrim(file_get_contents(CMS_SAFELOCKER.'/release')),
  'version' => rtrim(file_get_contents(CMS_SAFELOCKER.'/hacktor/release.log')),
];

$console = new Application('Metin2CMS', sprintf('%s::%s', $cmsinfo['repository'], $cmsinfo['version']));
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);

$console
  ->register('repo:git-version')
  ->setDefinition(array(
    // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
  ))
  ->setDescription('Display repository version from Git.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
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

    $output->writeln(sprintf('Version <info>%s</info> on repo <info>%s</info>', $version, $repository));
  });
$console
  ->register('repo:version')
  ->setDefinition(array(
    // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
  ))
  ->setDescription('Display repository version from cache.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $version = rtrim(file_get_contents(CMS_SAFELOCKER.'/hacktor/release.log'));
    $data = explode('::', $version);

    $output->writeln(sprintf('Version <info>%s</info> on repo <info>%s</info>', $data[1], $data[0]));
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
    $git->add('*')->commit($message)->push();
    $output->writeln('<info>Repository update complete.</info>');

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
  ->setDefinition(array(
    // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
  ))
  ->setDescription('Fetch changes from remote Git repository.')
  ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    $wrapper = new GitWrapper();
    $wrapper->setTimeout(3600);
    $git = $wrapper->workingCopy(CMS_ROOT);

    $git->fetchAll();
    $output->writeln('<info>Fetched all repositories from remote.</info>');
  });
return $console;
