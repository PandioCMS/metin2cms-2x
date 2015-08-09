<?php

function int2time($time, $format = '%d:%d') {
  if ($time < 1) {
    return;
  }

  $hours = floor($time / 60);
  $minutes = ($time % 60);
  return sprintf($format, $hours, $minutes);
}

function service($serviceName, $serviceParams) {
  #$cms->register(new Silex\Provider\ServiceNameServiceProvider(), ['param']);
  $svc = sprintf('new Silex\Provider\%sServiceProvider()', $serviceName);
  $cms->register($svc, $serviceParams);
}

function controller() {
  
}

function model() {
  
}

function view() {
  
}