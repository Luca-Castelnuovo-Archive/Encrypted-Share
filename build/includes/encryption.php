<?php

function encrypt($key, $plaintext)
{
    $full_key = $key . $GLOBALS['config']->encryption_key;

    $method = 'AES-256-CBC';
    $length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($length);
    $encrypted = openssl_encrypt($plaintext, $method, $full_key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($encrypted) . '|' . base64_encode($iv);
}

function decrypt($key, $encrypted)
{
    $full_key = $key . $GLOBALS['config']->encryption_key;

    $method = 'AES-256-CBC';
    list($data, $iv) = explode('|', $encrypted);
    $iv = base64_decode($iv);
    return openssl_decrypt($data, $method, $full_key, 0, $iv);
}
