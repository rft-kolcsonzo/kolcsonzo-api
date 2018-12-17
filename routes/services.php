<?php

$app->group('/services', function (){
    
    $this->get('', function ($request, $response) {    

        $carService = $this->serviceModel->getAllCarServices();	      
        
        return $response->withJson($carService);	     
    });	    

    $this->post('', function ($request, $response) {
        
        $datas = $request->getParsedBody();

        $response = $this->Car->validService($datas, true);
        $message = $this->serviceModel->getServiceById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
    });

    
    $this->get('/[{serviceId}]', function ($request, $response, $args) {	 

        $serviceId = $args['serviceId'];	 
       
        if ($carService = $this->serviceModel->geCarServiceById($serviceId)) {	       
         
            return $response->withJson($carService);	          
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen szervíz információ!' ], 404);	       
    });	   

    
    $this->put('/[{serviceId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['serviceId'];

        $response = $this->Service->validService($datas, false);
        $message = $this->serviceModel->getServiceById($response);
        
        return $this->response->withJson(['message' => $message ? $message : $response]);
    });

    $this->delete('/[{serviceId}]', function ($request, $response, $args) {

        $id = $args['serviceId'];

         if ($this->serviceModel->deleteCarService($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->get('/filter', function ($request, $response) {	 

        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');        

        if ($carService = $this->serviceModel->getByFilter($field, $keyword)) {	       
         
            return $response->withJson($carService);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti szervíz információ!' ], 404);	       
    });	
    
    
})->add($AuthenticationMiddleware); 