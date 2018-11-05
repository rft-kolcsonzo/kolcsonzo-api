<?php

$app->group('/carServices', function (){
    
    $this->get('', function ($request, $response) {

        $session = $request->getAttribute('session');	    

        $carService = $this->carServiceModel->getAllCarServices();	      
        
        return $response->withJson($car);	     
    });	    
    
    $this->get('/{carServiceId}', function ($request, $response, $args) {	 

        $carServiceId = $args['carServiceId'];	 

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($carService = $this->carServiceModel->geCarServiceById($carServiceId)) {	       
         
            return $response->withJson($carService);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen szervíz információ!' ], 404);	       
    });	   
    //filter soon
    $this->get('/{carServiceId}', function ($request, $response, $args) {	 
	 
        $filter;
        $keyword;

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($carService = $this->carServiceModel->getByFilter($filter, $keyword)) {	       
         
            return $response->withJson($carService);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti szervíz információ!' ], 404);	       
    });	
    
    $this->post('/insert', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->carServiceModel->insertCarService($datas);

        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{carServiceId}]', function ($request, $response, $args) {

        $id = $args['carServiceId'];

         if ($this->carServiceModel->deleteCarService($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->put('/[{carServiceId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['carServiceId'];
        $response = $this->orderModel->updateCarService($id, $datas);

        return $this->response->withJson(['message' => $response]);
    });
    
    
})->add($SessionMiddleware); 