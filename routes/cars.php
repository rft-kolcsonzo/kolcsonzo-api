<?php

$app->group('/cars', function (){
    // GET /orders
    $this->get('', function ($request, $response) {
        $session = $request->getAttribute('session');

        $cars = $this->carModel->getAll();
        //ide jon ha valami szempont szerint keresunk

        return $response->withJson($cars);
    });

    // GET /products/{productId}
    $this->get('/{carId}', function ($request, $response, $args) {
        $carId = $args['carId'];

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        if ($car = $this->carModel->get($carId)) {

            //ide jon ha valami szempont szerint keresunk
            
            return $response->withJson($car);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen autó!' ], 404);
    });
})->add($SessionMiddleware); // Use SessionMiddleware
