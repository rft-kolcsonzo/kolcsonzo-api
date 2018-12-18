x0<?php

$app-> group('/cars', function (){

    $this->get('', function ($request, $response) { 

        if($cars = $this->carModel->getAllCars())
        {
            $cars_array = array();
            $today = date('Y-m-d');
  
            foreach($cars as $carItem)
            {
                $valid_date = date('Y-m-d',strtotime( $carItem['insurance_until_date']));
              
                if($today < $valid_date) 
                    $carItem['insurance_status'] =  true; 
                else 
                    $carItem['insurance_status'] =  false; 

                $cars_array[] = $carItem;    	                
            }
    
            return $response->withJson($cars_array);
        }	 

        return $response->withJson([ 'message' => 'Nincsenek autók!' ], 404);	     
    });	   

    $this->get('/filter', function ($request, $response) {	 

        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');

        if ($cars = $this->carModel->getByFilter($field, $keyword)) {	       

            $today = date('Y-m-d');
            $cars_array = array();

            foreach($cars as $carItem){

                $valid_date = date('Y-m-d',strtotime( $carItem['insurance_until_date']));
    
                if($today < $valid_date)
                    $carItem['insurance_status'] =  true;
                else
                    $carItem['insurance_status'] =  false;	
                
                $cars_array[] = $carItem; 
            }

            return $response->withJson($cars_array);	          
        }	

        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti autó!' ], 404);	       
    });	

    $this->post('', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        
        $response = $this->Car->validCar($id, $datas, true);
        $message = $this->carModel->getCarById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
    });
	    
    $this->get('/[{carId}]', function ($request, $response, $args) {	 

        $carId = $args['carId'];         

        if ($car = $this->carModel->getCarById($carId)) {	       

            $today = date('Y-m-d');
            $valid_date = date('Y-m-d',strtotime( $car['insurance_until_date']));

            if( $today < $valid_date )
                $car['insurance_status'] =  true;
            else
                $car['insurance_status'] =  false;
                
            return $response->withJson($car);	          
        }	        

        return $response->withJson([ 'message' => 'Nem létezik ilyen autó!' ], 404);	       
    });	
    
    $this->put('/[{carId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['carId'];

        $response = $this->Car->validCar($id, $datas, false);
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

    
    
})->add($AuthenticationMiddleware); 