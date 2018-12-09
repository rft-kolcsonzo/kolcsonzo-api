<?php

$app->group('/services', function (){
    
    $this->get('', function ($request, $response) {

        $session = $request->getAttribute('session');	    

        $carService = $this->serviceModel->getAllCarServices();	      
        
        return $response->withJson($carService);	     
    });	    

    $this->post('', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->serviceModel->insertCarService($datas);

        return $this->response->withJson(['message' => $response]);
    });

    
    $this->get('/[{serviceId}]', function ($request, $response, $args) {	 

        $serviceId = $args['serviceId'];	 

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($carService = $this->serviceModel->geCarServiceById($serviceId)) {	       
         
            return $response->withJson($carService);	          
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen szervíz információ!' ], 404);	       
    });	   

    
    $this->put('/[{serviceId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $id = $args['serviceId'];
        $response = $this->serviceModel->updateCarService($id, $datas);

        return $this->response->withJson(['message' => $response]);
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

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($carService = $this->serviceModel->getByFilter($field, $keyword)) {	       
         
            return $response->withJson($carService);	          
        }	        
        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti szervíz információ!' ], 404);	       
    });	
    
    
})->add($SessionMiddleware); 