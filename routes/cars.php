<?php

$app->group('/cars', function () {

    $this->get('', function ($request, $response) {
        $filter = [];

        if (($available = $request->getQueryParam('available')) !== null) {
            $available = filter_var($available, FILTER_VALIDATE_BOOLEAN);

            $filter['available_status'] = $available;
        }

        $cars = $this->carModel->getAllCars($filter);
        $cars_array = array();
        $today = date('Y-m-d');

        foreach ($cars as $carItem) {
            $valid_date = date('Y-m-d', strtotime($carItem['insurance_until_date']));

            if ($today < $valid_date) {
                $carItem['insurance_status'] = true;
            } else {
                $carItem['insurance_status'] = false;
            }

            $cars_array[] = $carItem;
        }

        return $response->withJson($cars_array);
    });

    $this->get('/filter', function ($request, $response) {

        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');

        if ($cars = $this->carModel->getByFilter($field, $keyword)) {
            $today = date('Y-m-d');
            $cars_array = array();

            foreach ($cars as $carItem) {
                $valid_date = date('Y-m-d', strtotime($carItem['insurance_until_date']));

                if ($today < $valid_date)
                    $carItem['insurance_status'] = true;
                else
                    $carItem['insurance_status'] = false;

                $cars_array[] = $carItem;
            }

            return $response->withJson($cars_array);
        }

        return $response->withJson(['message' => 'Nem létezik ilyen filter szerinti autó!'], 404);
    });

    $this->post('', function ($request, $response) {
        $datas = $request->getParsedBody();

        try {
            $this->Car->validCar(null, $datas, true);

            $car = $this->carModel->getCarById($response);

            return $this->response->withJson($car);
        } catch (ValidationException $e) {
            return $response->withJson(['field' => $e->getField(), 'message' => $e->getMessage()], 406);
        }
    });

    $this->get('/[{carId}]', function ($request, $response, $args) {

        $carId = $args['carId'];

        if ($car = $this->carModel->getCarById($carId)) {

            $today = date('Y-m-d');
            $valid_date = date('Y-m-d', strtotime($car['insurance_until_date']));

            if ($today < $valid_date) {
                $car['insurance_status'] = true;
            } else {
                $car['insurance_status'] = false;
            }

            return $response->withJson($car);
        }

        return $response->withJson(['message' => 'Nem létezik ilyen autó!'], 404);
    });

    $this->put('/[{carId}]', function ($request, $response, $args) {
        $datas = $request->getParsedBody();
        $id = $args['carId'];

        try {
            $this->Car->validCar($id, $datas, false);
            $car = $this->carModel->getCarById($id);

            return $this->response->withJson($car);
        } catch (ValidationException $err) {
            return $response->withJson(['field' => $err->getField(), 'message' => $err->getField()], 406);
        }
    });

    $this->delete('/[{carId}]', function ($request, $response, $args) {

        $id = $args['carId'];

        if ($this->carModel->deleteCar($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    });



})->add($AuthenticationMiddleware);
