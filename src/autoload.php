<?php
spl_autoload_register('loadClass');

function loadClass($class) {
    $class = str_replace('src', '', $class);
    $class = str_replace('\\', '/', $class);
    $class = $class . '.php';

    try {
        if (file_exists(__DIR__ . $class)) {
            require_once __DIR__ . $class;
        } else {
            throw new Exception('Classe ' . $class . ' not found.');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}