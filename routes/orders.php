<?php

$app->group('/orders', function () {
    // GET /orders

    $this->get('', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $orders = $this->orderModel->getAllOrder();

        return $response->withJson($orders);
    });

    //get active orders
    $this->get('/active_orders', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $orders = $this->orderModel->getActiveOrders();

        return $response->withJson($orders);
    });

    //get closed orders
    $this->get('/closed_orders', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $orders = $this->orderModel->getClosedOrders();

        return $response->withJson($orders);
    });

    //get orders by period
    $this->get('/startperiod', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $startdate = $request->getQueryParam('startdate');
        $enddate = $request->getQueryParam('enddate');

        $orders = $this->orderModel->getOrdersByStartPeriod($startdate, $enddate);

        return $response->withJson($orders);
    });

    //get orders by period
    $this->get('/endperiod', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $startdate = $request->getQueryParam('startdate');
        $enddate = $request->getQueryParam('enddate');

        $orders = $this->orderModel->getOrdersByEndPeriod($startdate, $enddate);

        return $response->withJson($orders);
    });

    //get orders by car parameters
    $this->get('/cars', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $carField = $request->getQueryParam('field');
        $carValue = $request->getQueryParam('keyword');

        $cars = $this->carModel->getByFilter($carField, $carValue);
        $ordersByCarArray = array();


        foreach ($cars as $carItem) {
            $orderByCar = $this->orderModel->getOrderByField('car_id', $carItem['car_id']);
            $ordersByCarArray[] = $orderByCar;
        }

        return $response->withJson($ordersByCarArray);

    });


    //GET /orders/filter
    $this->get('/filter', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');


        $response = $this->orderModel->getByFilter($field, $keyword);
        return $this->response->withJson(['message' => $response]);
    });

    //POST /orders/multifilter
    $this->post('/multifilter', function ($request, $response) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $jsonBody = $request->getParsedBody();
        $jsonArray = json_decode($jsonBody['multifilter'], true);


        $response = $this->orderModel->getByMultiFilter($jsonArray);
        return $this->response->withJson(['message' => $response]);
    });

    // GET /orders/{orderId}
    $this->get('/{orderId}', function ($request, $response, $args) {
        /*
        $session = $request->getAttribute('session');

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }
         */
        $id = $args['orderId'];

        if ($order = $this->orderModel->getOrderById($id)) {

            return $response->withJson($order);
        }

        return $response->withJson(['message' => 'Nem létezik ilyen rendelés!'], 404);
    });

    // GET /orders/print-to-pdf/{orderId}
    $this->get('/{orderId}/pdf', function ($request, $response, $args) {
        $id = $args['orderId'];

        if ($order = $this->orderModel->getOrderById($id)) {
            require('includes/functions.php');
            $car = $this->carModel->getCarById($order['car_id']);
            $order = $this->orderModel->getOrderById($id);
            $buffer = generate_pdf($order, $car);
            $filename = sprintf('berleti_szerzodes_ON%05d.pdf', $order['rent_id']);
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Connection: Keep-Alive');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');

            echo $buffer;
            exit;
        } else {
            return $response->withJson(['message' => 'Nem létezik ilyen rendelés!'], 404);
        }
    });

    $this->post('', function ($request, $response) {
        $datas = $request->getParsedBody();
        $user = $request->getAttribute('user');

        $datas['user_id'] = $user['user_id'];

        try {
            $orderId = $this->Order->createOrder($datas);

            $order = $this->orderModel->getOrderById($orderId);

            return $response->withJson($order, 201);
        } catch (ValidationException $err) {
            return $response->withJson(['field' => $err->getField(), 'message' => $err->getMessage()], 406);
        }
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

        try {
            $orderId = $this->Order->updateOrder($id, $datas);

            $order = $this->orderModel->getOrderById($id);

            return $response->withJson($order);
        } catch (ValidationException $err) {
            return $response->withJson(['field' => $err->getField(), 'message' => $err->getMessage()], 406);
        }
    });
})->add($AuthenticationMiddleware);
