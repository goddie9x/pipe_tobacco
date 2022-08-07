<?php
function autoloadClassWithNameSpaceInApp($class)
{
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $file = realpath(__DIR__ . '/../' . $class . '.php');
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoloadClassWithNameSpaceInApp');