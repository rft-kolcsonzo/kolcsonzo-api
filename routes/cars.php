<?php

$app->group('/cars', function (){

    $this->get('', function ($request, $response) {

        $session = $request->getAttribute('session');	    

        $car = $this->carModel->getAll();	      
        
        return $response->withJson($car);	     
    });	    
	    
    $this->get('/{carId}', function ($request, $response, $args) {	 

        $carId = $args['carId'];	 

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($car = $this->carModel->getCarById($carId)) {	       
         
            return $response->withJson($car);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen autó!' ], 404);	       
    });	  
    // get by filter, soon
    $this->get('/{carId}', function ($request, $response, $args) {	 

        $filter;
        $keyword;	 

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($car = $this->carModel->getByFilter($filter, $keyword)) {	       
         
            return $response->withJson($car);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti autó!' ], 404);	       
    });	
    
    $this->post('/insert', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->carModel->insertCar($datas);

        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{carId}]', function ($request, $response, $args) {

        $id = $args['carID'];

         if ($this->carModel->deleteCar($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->put('/[{carId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['carId'];
        $response = $this->orderModel->updateCar($id, $datas);

        return $this->response->withJson(['message' => $response]);
    });
    
    
})->add($SessionMiddleware); 