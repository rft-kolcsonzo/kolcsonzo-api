<?php

$app-> group('/cars', function (){

    $this->get('', function ($request, $response) { 

        $car = $this->carModel->getAllCars();	      
    
        return $response->withJson($car);	     
    });	   

    $this->post('', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->carModel->insertCar($datas);

        return $this->response->withJson(['message' => $response]);
    });
	    
    $this->get('/[{carId}]', function ($request, $response, $args) {	 

        $carId = $args['carId'];	        

        if ($car = $this->carModel->getCarById($carId)) {	       
         
            return $response->withJson($car);	          
        }	        

        return $response->withJson([ 'message' => 'Nem létezik ilyen autó!' ], 404);	       
    });	  
    
    $this->put('/[{carId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['carId'];
        $response = $this->carModel->updateCar($id, $datas);

        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{carId}]', function ($request, $response, $args) {

        $id = $args['carId'];

        if ($this->carModel->deleteCar($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 


    $this->get('/filter', function ($request, $response) {	 

        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');
   

        if ($car = $this->carModel->getByFilter($field, $keyword)) {	       
         
            return $response->withJson($car);	          
        }	

        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti autó!' ], 404);	       
    });	
    
    
})->add($SessionMiddleware); 