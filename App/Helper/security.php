<?php
function genarateSecurityToken(){
    return md5(time() . rand(0, 9999));
}
function renewAppEnvKey(){
    $env = parse_ini_file('.env');
    $env['APP_KEY'] = genarateSecurityToken();
    $envFile = fopen('.env', 'w');
    foreach($env as $key => $value){
        fwrite($envFile, $key . '=' . $value . PHP_EOL);
    }
    fclose($envFile);
}

function createJWT($payload){
    $key = env('APP_KEY');
    $jwt = App\Helper\JWT::encode($payload, $key);
    return $jwt;
}