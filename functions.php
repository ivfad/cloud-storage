<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function base_path($path):string
{
    return BASE_PATH . $path;
}
