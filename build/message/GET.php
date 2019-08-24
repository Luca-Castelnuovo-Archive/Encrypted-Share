<?php

function METHOD_GET($token) {
    $token = check_data($token, true, 'Token', true);
    $message = sql_select('messages', 'expires,message,used', "token='{$token}'", false);

    if ($message->num_rows != 1) {
        response(false, 'Token invalid');
    } else {
        $message = $message->fetch_assoc();
    }

    if ($message['used']) {
        response(false, 'Token already used');
    }

    if ($message['expires'] <= time()) {
        sql_update('messages', ['used' => '1', 'message' => 'EXPIRED'], "token='{$token}'");
        response(false, 'Token expired');
    }

    sql_update('messages', ['used' => '1', 'message' => 'VIEWED'], "token='{$token}'");

    $message = decrypt($token, $message['message']);
    $message = str_replace("\\n", "\n", $message);
    $message = nl2br($message);

    return ["message" => "{$message}"];
}
