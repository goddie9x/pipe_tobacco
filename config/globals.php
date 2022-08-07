<?php
$env = parse_ini_file('.env');
$viewShare=[];
$listRoutePath = [];

function env($key, $default = null) {
  global $env;
  return isset($env[$key]) ? $env[$key] : $default;
}
function echoObject($object) {
  echo '<pre>';
  print_r($object);
  echo '</pre>';
}
function array_is_list($array) {
  return array_values($array)!==$array;
}