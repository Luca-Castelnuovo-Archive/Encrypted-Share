<?php

function METHOD_POST($access_token, $message, $expires) {
    $access_token = check_data($access_token, true, 'Access Token', true);
    $message = check_data($message, true, 'Message', true);
    $expires = check_data($expires, true, 'Expires', true);

    try {
        api_get_token($access_token);
    } catch (Exception $error) {
        response(false, $error->getMessage());
    }

    $token = bin2hex(random_bytes(64));
    $expires = time() + $expires;

    $message = encrypt($token, $message);

    sql_insert('messages', ['token' => $token, 'expires' => $expires, 'message' => $message]);

    return ["url" => "https://share.lucacastelnuovo.nl/view/{$token}", "api_url" => "https://share.lucacastelnuovo.nl/message/{$token}"];
}
