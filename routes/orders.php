<?php

$app->group('/orders', function (){
    // GET /orders
    $this->get('', function ($request, $response) {
        $session = $request->getAttribute('session');
        
        $orders = $this->orderModel->getAllOrder();
        
        return $response->withJson($orders);
    });

    // GET /orders/{orderId}
    $this->get('/{orderId}', function ($request, $response, $args) {
        $id = $args['orderId'];

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        if ($order = $this->orderModel->getOrderById($id)) {

            return $response->withJson($order);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen rendelés!' ], 404);
    });
    
    $this->post('/insert', function ($request, $response) {
        
        /*if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }*/

        $datas = $request->getParsedBody();
        $response = $this->orderModel->insertOrder($datas);
        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{orderId}]', function ($request, $response, $args) {
        $id = $args['orderId'];

        if ($this->orderModel->deleteOrder($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->put('/[{orderId}]', function ($request, $response, $args) {
        $datas = $request->getParsedBody();
        $id = $args['orderId'];
        $response = $this->orderModel->updateOrder($id, $datas);
        return $this->response->withJson(['message' => $response]);
    });
    
    $this->get('/filter/{orderId}/', function ($request, $response, $args) {
        $field = args['field'];
        $keyword;
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
        if ($order = $this->orderModel->getByFilter($field, $keyword)) {
            return $response->withJson($order);
        }
        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti autó!' ], 404);
    });

    
})->add($SessionMiddleware); // Use SessionMiddleware
