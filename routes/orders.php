<?php

$app->group('/orders', function (){
    // GET /orders
    $this->get('', function ($request, $response) {
        $session = $request->getAttribute('session');

        $orders = $this->orderModel->getAll();
        //ide jon ha valami szempont szerint keresunk

        return $response->withJson($orders);
    });

    // GET /orders/{orderId}
    $this->get('/{orderId}', function ($request, $response, $args) {
        $orderId = $args['orderId'];

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        if ($order = $this->orderModel->get($orderId)) {

            //ide jon ha valami szempont szerint keresunk
            
            return $response->withJson($order);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen rendelés!' ], 404);
    });
})->add($SessionMiddleware); // Use SessionMiddleware
