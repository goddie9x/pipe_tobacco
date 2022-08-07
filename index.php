<?php
try{
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once 'config/index.php';
    include_once 'App/Helper/index.php';
    include_once 'bootstrap/bootstrap.php';
    include_once 'route/web.php';
}
catch(Exception $e){
    writeLog($e->getMessage());
}
