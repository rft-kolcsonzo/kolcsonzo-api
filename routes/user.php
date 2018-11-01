<?php

$app->group('/users', function (){
    // GET /orders
    $this->get('', function ($request, $response) {
        $session = $request->getAttribute('session');

        $users = $this->userModel->getAll();
        //ide jön ha valami szempont szerint keresünk

        return $response->withJson($users);
    });

    // GET /products/{productId}
    $this->get('/{userId}', function ($request, $response, $args) {
        $userId = $args['userId'];

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        if ($order = $this->userModel->get($userId)) {

            //ide jön ha valami szempont szerint keresünk
            
            return $response->withJson($user);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen felhasználó!' ], 404);
    });
})->add($SessionMiddleware); // Use SessionMiddleware
