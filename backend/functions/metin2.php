<?php

function job2chartype($int) {
  switch($int):
    case 0:
      $out = 'Razboinic (M)';
      break;
    case 1:
      $out = 'Ninja (F)';
      break;
    case 2:
      $out = 'Sura (M)';
      break;
    case 3:
      $out = 'Saman (F)';
      break;
    case 4:
      $out = 'Razboinic (F)';
      break;
    case 5:
      $out = 'Ninja (M)';
      break;
    case 6:
      $out = 'Sura (F)';
      break;
    case 7:
      $out = 'Saman (M)';
      break;
    default:
      $out = 'Invalid';
      break;
  endswitch;

  return $out;
}

function job2sex($int) {
  switch($int):
    case 0:
    case 2:
    case 5:
    case 7:
      $out = 'Mister';
      break;
    case 1:
    case 3:
    case 4:
    case 6:
      $out = 'Miss';
      break;
    default:
      $out = 'Sex invalid';
      break;
  endswitch;

  return $out;
}
