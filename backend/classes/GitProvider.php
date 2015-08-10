<?php

namespace Hacktor\Kernel;

class GitProvider {
  public $version;
  public $changes;
  public $releaseLog;
  public $changesLog;
  public $cmsType;

  public function __construct($release, $changes, $cmstype) {
    $this->releaseLog = $release;
    $this->changesLog = $changes;
    $this->cmsType = $cmstype;
  }

  public function getChanges() {
    $this->changes = file_exists($this->changesLog) ? file_get_contents($this->changesLog) : 'unable_get';
    return $this->changes;
  }

  public function getVersion() {
    $this->version = file_exists($this->releaseLog) ? rtrim(file_get_contents($this->releaseLog)) : 'unable_get';
    return $this->version;
  }

  public function isProperEnv() {
    if (defined('CMS_WIP') && CMS_WIP && preg_match('/(linux)/i', PHP_OS) && function_exists('exec')) {
      return true;
    } else {
      return false;
    }
  }

  public function setVersion() {
    if ($this->isProperEnv()) {
      if ($this->cmsType == 'standard') {
        $release = sprintf('git describe --abbrev=0 --tag --exact-match > %s', $this->releaseLog);
      } else if ($this->cmsType == 'nightly') {
        $release = sprintf('git rev-parse --short HEAD > %s', $this->releaseLog);
      } else {
        $release = null;
      }

      if(exec($release)) {
        return true;
      } else {
        return false;
      }
    }
  }

  public function setChanges() {
    if ($this->isProperEnv()) {
      $log = sprintf('git log > %s', $this->changesLog);

      if (exec($log)) {
        return true;
      } else {
        return false;
      }
    }
  }
}
