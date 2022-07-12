<?php
function writeLog($message)
{
    $log = './storage/tam.log';
    $message = date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;
    file_put_contents($log, $message, FILE_APPEND);
}