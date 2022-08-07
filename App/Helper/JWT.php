<?php
namespace App\Helper;
class JWT{
    public static function encode($payload, $key){
        $header = json_encode(array('alg' => 'HS256', 'typ' => 'JWT'));
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
    public static function decode($jwt, $key){
        $jwt = explode('.', $jwt);
        $base64UrlHeader = str_replace(['-', '_'], ['+', '/'], $jwt[0]);
        $base64UrlPayload = str_replace(['-', '_'], ['+', '/'], $jwt[1]);
        $base64UrlSignature = str_replace(['-', '_'], ['+', '/'], $jwt[2]);
        $header = json_decode(base64_decode($base64UrlHeader), true);
        $payload = json_decode(base64_decode($base64UrlPayload), true);
        $signature = base64_decode($base64UrlSignature);
        if(hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true) === $signature){
            return $payload;
        }
        return false;
    }
}