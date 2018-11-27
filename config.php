<?php

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$inDocker = getenv('RUNTIME') === 'DOCKER';

if ($inDocker) {
    $config['db']['host'] = getenv('DB_HOST');
    $config['db']['user'] = getenv('DB_USER');
    $config['db']['pass'] = getenv('DB_PASSWORD');
    $config['db']['dbname'] = getenv('DB_NAME');
} else {
    $config['db']['host'] = 'localhost';
    $config['db']['user'] = 'root';
    $config['db']['pass'] = '';
    $config['db']['dbname'] = 'car_rental';
}
