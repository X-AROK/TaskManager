<?php
ini_set('display_errors', 1);
define('ROOT_PATH', __DIR__);
require __DIR__ . '/vendor/autoload.php';

\App\App::init();

session_start();

\App\App::run();