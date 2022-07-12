<?php
function autoloadModels($class)
{
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '../models/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
function autoloadController($class)
{
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '../controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoloadModels');
spl_autoload_register('autoloadController');