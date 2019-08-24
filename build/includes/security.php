<?php

function is_empty($var, $type)
{
    if (empty($var)) {
        response(false, "{$type} is empty");
    }
}

function clean_data($data)
{
    $conn = sql_connect();
    $data = $conn->escape_string($data);
    sql_disconnect($conn);

    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

function check_data($data, $isEmpty = true, $isEmptyType = 'Unknown', $clean = true)
{
    if ($isEmpty) {
        is_empty($data, $isEmptyType);
    }

    if ($clean) {
        return clean_data($data);
    } else {
        return $data;
    }
}
