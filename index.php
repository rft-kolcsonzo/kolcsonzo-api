<?php

require 'vendor/autoload.php';
require_once 'config.php';
require_once 'lib/Model.php';
require_once 'lib/Criteria.php';

$app = new \Slim\App([ 'settings' => $config ]);
$container = $app->getContainer();

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new \Slim\PDO\Database(
        "mysql:host=". $db['host'] . ";dbname=" . $db['dbname'] . ";charset=utf8",
        $db['user'],
        $db['pass']
    );

    return $pdo;
};

$container['carModel'] = function ($container) {
    require_once 'models/CarModel.php';

    return new CarModel($container);
};

$container['userModel'] = function ($container) {
    require_once 'models/UserModel.php';

    return new UserModel($container);
};

$container['orderModel'] = function ($container) {
    require_once 'models/OrderModel.php';

    return new OrderModel($container);
};

$container['sessionModel'] = function ($container) {
    require_once 'models/SessionModel.php';

    return new SessionModel($container);
};

$container['User'] = function ($container) {
    require_once 'lib/User.php';

    return new User($container);
};

require_once 'middlewares/session.php';

$SessionMiddleware = new SessionMiddleware($container->sessionModel);

require_once 'routes/cars.php';
require_once 'routes/user.php';
require_once 'routes/orders.php';

// Add middleware function: this function will be called with every request
$app->add(function ($req, $res, $next) {
    // Get response object from other middlewares/handler
    $response = $next($req, $res);

    // Middlewares must return a Response object.
    // This will add CORS headers
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, X-Session-Token')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
});

$app->run();
