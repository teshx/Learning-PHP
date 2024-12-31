<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className)
{
    $path = 'config/';
    $extension = '.php';
    $fileName = $path . $className . $extension;

    if (!file_exists($fileName)) {

        return false;
    }

    include_once $fileName;
}
