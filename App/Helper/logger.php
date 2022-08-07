<?php
function writeLog($message,$line = 0,$file = __FILE__)
{
    if(!is_string($message)){
        $message = json_encode($message);
    }
    $log = date('Y-m-d H:i:s') . ' - ' . $message . ' at: ' .PHP_EOL;
    $backtrace = debug_backtrace();
    foreach ($backtrace as $key => $value) {
        if ($key > 0) {
            $log .=' at line ' . $value['line'].': '. $value['file'] . ':' .PHP_EOL;
        }
    }
    file_put_contents('./storage/tam.log', $log, FILE_APPEND);
}