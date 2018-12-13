<?php

$app-> group('/cars', function (){

    $this->get('', function ($request, $response) { 

        $cars = $this->carModel->getAllCars();	 
        
        foreach($cars as $one_car => $car)
        {
            foreach($car as $car_key => $car_value)
            {
                if($car_key == "insurance_until_date")       
        
                    $today = date("Y-m-d");
                    $valid_date = date("Y-m-d", $car_value);
        
                    if($today > $valid_date)
                        $car["insurance_status"] =  true;
                    else
                        $car["insurance_status"] =  false;
            }
        }

        return $response->withJson($cars);	     
    });	   

    $this->post('', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->Car->insertCar($datas);
        $message = $this->carModel->getCarById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
    });
	    
    $this->get('/[{carId}]', function ($request, $response, $args) {	 

        $carId = $args['carId']; 
        $insuranceDate = $request->getAttribute('insurance_until_date');

        if ($car = $this->carModel->getCarById($carId)) {	       

            $today = date("Y-m-d");
            $valid_date = date("Y-m-d", $insurance_until_date);

            if($today > $valid_date)
                $car["insurance_status"] =  true;
            else
                $car["insurance_status"] =  false;
                
            return $response->withJson($car);	          
        }	        

        return $response->withJson([ 'message' => 'Nem létezik ilyen autó!' ], 404);	       
    });	  
    
    $this->put('/[{carId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['carId'];
        $response = $this->Car->updateCar($id, $datas);
        $message = $this->carModel->getCarById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
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
    
    
})->add($AuthenticationMiddleware); 