<?php

session_start();

$GLOBALS['config'] = require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

require($_SERVER['DOCUMENT_ROOT'] . '/includes/authentication.php');
require($_SERVER['DOCUMENT_ROOT'] . '/includes/encryption.php');
require($_SERVER['DOCUMENT_ROOT'] . '/includes/security.php');
require($_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php');


function response($success, $message = null, $extra = null)
{
    $output = ["success" => $success];

    if (isset($message) && !empty($message)) {
        if ($success) {
            $output = array_merge($output, ["message" => $message]);
        } else {
            $output = array_merge($output, ["error" => $message]);
        }
    }

    if (!empty($extra)) {
        $output = array_merge($output, $extra);
    }

    echo json_encode($output);
    exit;
}
