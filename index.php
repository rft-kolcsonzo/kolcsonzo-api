<?php

require 'vendor/autoload.php';
require_once 'config.php';
require_once 'lib/Model.php';
require_once 'lib/Criteria.php';
require_once 'exceptions/ValidationException.php';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new \Slim\PDO\Database(
        "mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'] . ";charset=utf8",
        $db['user'],
        $db['pass']
    );

    return $pdo;
};

$container['carModel'] = function ($container) {
    require_once 'models/CarModel.php';

    return new CarModel($container);
};

$container['serviceModel'] = function ($container) {
    require_once 'models/ServiceModel.php';

    return new ServiceModel($container);
};

$container['imageModel'] = function ($container) {
    require_once 'models/ImageModel.php';

    return new ImageModel($container);
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

$container['Car'] = function ($container) {
    require_once 'lib/Car.php';

    return new Car($container);
};

$container['Image'] = function ($container) {
    require_once 'lib/Image.php';

    return new Image($container);
};

$container['Service'] = function ($container) {
    require_once 'lib/Service.php';

    return new Service($container);
};

$container['Order'] = function ($container) {
    require_once 'lib/Order.php';

    return new Order($container);
};


require_once 'middlewares/session.php';
require_once 'middlewares/auth.php';



$app->group($config['basePath'], function () use ($app, $container) {
    $SessionMiddleware = new SessionMiddleware($container->sessionModel);
    $AuthenticationMiddleware = new AuthenticationMiddleware($container->sessionModel);

    require_once 'routes/cars.php';
    require_once 'routes/services.php';
    require_once 'routes/images.php';
    require_once 'routes/user.php';
    require_once 'routes/auth.php';
    require_once 'routes/orders.php';
});

$app->add(function ($req, $res, $next) {
    try {
        return $next($req, $res);
    } catch (Exception $err) {
        return $res->withJson(['message' => $err->getMessage()], 500);
    }
});

// Add middleware function: this function will be called with every request
$app->add(function ($req, $res, $next) {
    if ($req->isOptions()) {
        return $res
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, X-Session-Token')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->withStatus(204);
    }

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
