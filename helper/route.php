<?php
function route($patch) {
    $patch = str_replace('.', '/', $patch);
    $patch = __DIR__ . '/../views/' . $patch . '.php';
    if (file_exists($patch)) {
        require_once $patch;
    } else {
        echo 'View not found';
    }
}