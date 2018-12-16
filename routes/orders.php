<?php

$app->group('/orders', function (){
    // GET /orders

    $this->get('', function ($request, $response) {
        $session = $request->getAttribute('session');
        
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $orders = $this->orderModel->getAllOrder();
        
        return $response->withJson($orders);
    });

    //get active orders
    $this->get('/active_orders', function ($request, $response) {
        $session = $request->getAttribute('session');
        
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $orders = $this->orderModel->getActiveOrders();
        
        return $response->withJson($orders);
    });
    
    //get closed orders
    $this->get('/closed_orders', function ($request, $response) {
        $session = $request->getAttribute('session');
        
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $orders = $this->orderModel->getClosedOrders();
        
        return $response->withJson($orders);
    });
    
    //get orders by period
    $this->get('/startperiod', function ($request, $response) {
        $session = $request->getAttribute('session');
		
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $startdate = $request->getQueryParam('startdate');
        $enddate = $request->getQueryParam('enddate');
        
        $orders = $this->orderModel->getOrdersByStartPeriod($startdate, $enddate);
        
        return $response->withJson($orders);
    });
    
    //get orders by period
    $this->get('/endperiod', function ($request, $response) {
        $session = $request->getAttribute('session');
		
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $startdate = $request->getQueryParam('startdate');
        $enddate = $request->getQueryParam('enddate');
        
        $orders = $this->orderModel->getOrdersByEndPeriod($startdate, $enddate);
        
        return $response->withJson($orders);
    });
    
    //get orders by car parameters
    $this->get('/cars', function ($request, $response) {
        $session = $request->getAttribute('session');
		
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $carField = $request->getQueryParam('field');
        $carValue = $request->getQueryParam('keyword');
         
        $cars = $this->carModel->getByFilter($carField, $carValue);
		$ordersByCarArray = array();

		
		foreach($cars as $carItem){
			$orderByCar = $this->orderModel->getOrderByField('car_id', $carItem['car_id']);
			$ordersByCarArray[] = $orderByCar;	
		}
        
        return $response->withJson($ordersByCarArray);
		
    });
    
    
    //GET /orders/filter
    $this->get('/filter', function ($request, $response) {
        $session = $request->getAttribute('session');
        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        $response = $this->orderModel->getByFilter($field, $keyword);
        return $this->response->withJson(['message' => $response]);
    });

    // GET /orders/{orderId}
    $this->get('/{orderId}', function ($request, $response, $args) {
        $session = $request->getAttribute('session');
        $id = $args['orderId'];

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        if ($order = $this->orderModel->getOrderById($id)) {

            return $response->withJson($order);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen rendelés!' ], 404);
    });
    
    $this->post('/', function ($request, $response) {
        $session = $request->getAttribute('session');
        
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        $datas = $request->getParsedBody();
        $response = $this->orderModel->insertOrder($datas);
        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{orderId}]', function ($request, $response, $args) {
        $session = $request->getAttribute('session');
		
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $id = $args['orderId'];

        if ($this->orderModel->deleteOrder($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->put('/[{orderId}]', function ($request, $response, $args) {
        $session = $request->getAttribute('session');
		
        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
		
        $datas = $request->getParsedBody();
        $id = $args['orderId'];
        $response = $this->orderModel->updateOrder($id, $datas);
        return $this->response->withJson(['message' => $response]);
    });
    

    
})->add($SessionMiddleware); // Use SessionMiddleware
