<?php

/**
 * define base path project
 */
define('BASE_URL', 'http://localhost:8000');

define('BASE_ROOT', 'http://localhost:8000');

/**
 * show the error and die project
 * return value 
 */
function dd($var) 
{
    echo "<pre>";
    var_dump($var);
    exit();
}

/**
 * redirect us to the specific url
 * return us
 */
function redirect($url)
{
    header("Location: " . trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
    exit();
}


/**
 * making a url
 * return us to the created url 
 */
function url($url, $value = null)
{
    return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ') . $value ?? null;
}

/**
 * find the file from assets folder
 * return file 
 */
function asset($file) 
{
    return trim(BASE_URL, '/ ') . '/' . trim($file, '/ ');
}

function base_path($path)
{
    trim(BASE_URL, '/') . '/' . trim($path, '/ ');
}