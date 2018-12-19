<?php

$app->group('/services', function (){
    
    $this->get('', function ($request, $response) {    

        if($carService = $this->serviceModel->getAllCarServices())
        {

            return $response->withJson($carService);
        }	      
        
        return $response->withJson([ 'message' => 'Nincsenek szervíz információk!' ], 404);
	     
    });	    

    
    $this->get('/filter', function ($request, $response) {	 

        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');        

        if ($carService = $this->serviceModel->getByFilter($field, $keyword)) {	       
         
            return $response->withJson($carService);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti szervíz információ!' ], 404);	       
    });	

    $this->post('', function ($request, $response) {
        
        $datas = $request->getParsedBody();

        $response = $this->Service->validService($id, $datas, true);
        $message = $this->serviceModel->getCarServiceById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
    });

    
    $this->get('/[{carId}]', function ($request, $response, $args) {	 

        $carId = $args['carId'];	 
       
        if ($carService = $this->serviceModel->getCarServiceById($carId)) {	       
         
            return $response->withJson($carService);	          
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen szervíz információ!' ], 404);	       
    });	   

    
    $this->put('/[{carId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['carId'];

        $response = $this->Service->validService($id, $datas, false);
        $message = $this->serviceModel->getCarServiceById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
    });

    $this->delete('/[{carId}]', function ($request, $response, $args) {

        $id = $args['carId'];

         if ($this->serviceModel->deleteCarService($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    
    
})->add($AuthenticationMiddleware); 