<?php
// Code debug
function debug($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

// Get array value
function array_value($array, $key, $default = false, $check_value = false)
{
    if (is_array($array) && isset($array[$key])) {
        $data = $array[$key];

        if ($data) {
            return $data;
        } else {
            return $check_value ? $default : $data;
        }
    }

    return $default;
}

// Filters array by given condition
function filter_array($data, $where, $single_item = false)
{
    $result = [];

    foreach ($data as $row) {
        $condition = true;

        foreach ($where as $field => $value) {
            if ($row[$field] != $value) {
                $condition  = false;
                break;
            }
        }

        if ($condition) {
            $result[] = $row;
        }
    }

    if ($result && $single_item) {
        return array_values($result)[0];
    }

    return $result;
}

// Filters array by given fields
function filter_array_fields($array, $fields)
{
    $result = [];

    foreach ($array as $item) {
        if (is_string($fields)) {
            $result[] = array_value($item, $fields);
        } elseif (is_array($fields)) {
            $field_item = array();

            foreach ($fields as $field) {
                if (isset($item[$field])) {
                    $field_item[$field] = $item[$field];
                }
            }

            $result[] = $field_item;
        }
    }

    return $result;
}

// Array to sql query IN
function array_to_sql_query_in($array)
{
    $results = array();

    if (is_array($array) && $array) {
        foreach ($array as $item) {
            $results[] = "'" . trim($item) . "'";
        }
    }

    return implode(', ', $results);
}

// Item json decode from array by key
function item_json_decode($array, $key, $as_array = true)
{
    $result = array();

    if (is_array($array) && isset($array[$key])) {
        $data = $array[$key];

        if (!is_null($data) && !empty($data)) {
            $result = json_decode($data, $as_array);
        }
    }

    return $result;
}

// Item unserialize from array by key
function item_unserialize($array, $key)
{
    $result = array();

    if (is_array($array) && isset($array[$key])) {
        $data = $array[$key];

        if (!is_null($data) && !empty($data)) {
            $result = unserialize($data);
        }
    }

    return $result;
}

// Get HOST
function get_host()
{
    $host = '';
    $possibleHostSources = array('HTTP_X_FORWARDED_HOST', 'HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR');
    $sourceTransformations = array(
        "HTTP_X_FORWARDED_HOST" => function ($value) {
            $elements = explode(',', $value);
            return trim(end($elements));
        }
    );

    foreach ($possibleHostSources as $source) {
        if (!empty($host)) {
            break;
        }
        if (empty($_SERVER[$source])) {
            continue;
        }
        $host = $_SERVER[$source];
        if (array_key_exists($source, $sourceTransformations)) {
            $host = $sourceTransformations[$source]($host);
        }
    }

    // Remove port number from host
    $host = preg_replace('/:\d+$/', '', $host);

    return trim($host);
}

// Delete files in dir
function delete_files_in_dir($dir)
{
    if (is_dir($dir)) {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                delete_files_in_dir($file);
            } else {
                unlink($file);
            }
        }

        rmdir($dir);
    }
}

// Select array with empty label
function select_array_with_empty_label($array, $label = '-', $key = '')
{
    $default = array($key => $label);

    if (is_array($array) && $array) {
        return array_merge($default, $array);
    }

    return $default;
}

// Send email
function send_mail($to, $subject, $view, $data = array())
{
    $senderEmail = get_param('senderEmail');
    $senderName = get_param('senderName');

    \Yii::$app->mailer
        ->compose($view, $data)
        ->setFrom([$senderEmail => $senderName])
        ->setTo($to)
        ->setSubject($subject)
        ->send();
}

// Translation
function _t($category, $message, $params = array())
{
    return \Yii::t($category, $message, $params);
}

// Translation app
function _e($message, $params = array())
{
    return \Yii::t('app', $message, $params);
}