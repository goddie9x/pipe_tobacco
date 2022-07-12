<?php
$env = parse_ini_file('.env');
function env($key, $default = null) {
  global $env;
  return isset($env[$key]) ? $env[$key] : $default;
}
$enviroment = env('APP_ENV', 'production');