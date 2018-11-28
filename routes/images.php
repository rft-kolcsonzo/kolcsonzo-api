<?php

$app-> group('/images', function (){

    $this->get('', function ($request, $response) {

        $session = $request->getAttribute('session');	    

        $carImage = $this->imageModel->getAllCarImages();	      
    
        return $response->withJson($carImage);	     
    });	   
    
    $this->get('/filter', function ($request, $response) {	 

        $field = $request->getQueryParam('field');
        $keyword = $request->getQueryParam('keyword');

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	     

        if ($carImage = $this->imageModel->getByFilter($field, $keyword)) {	       
         
            return $response->withJson($carImage);	          
        }	

        return $response->withJson([ 'message' => 'Nem létezik ilyen filter szerinti kép!' ], 404);	       
    });	
	    
    $this->get('/{fileId}', function ($request, $response, $args) {	 

        $fileId = $args['fileId'];	 

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($carImage = $this->imageModel->getCarImageById($fileId)) {	       
         
            return $response->withJson($carImage);	          
        }	        

        return $response->withJson([ 'message' => 'Nem létezik ilyen kép!' ], 404);	       
    });	  
    
    $this->post('/insert', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->imageModel->insertCarImage($datas);

        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{fileId}]', function ($request, $response, $args) {

        $fileId = $args['fileId'];

        if ($this->imageModel->deleteCarImage($fileId)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->put('/[{fileId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $fileId = $args['fileId'];
        $response = $this->imageModel->updateCarImage($fileId, $datas);

        return $this->response->withJson(['message' => $response]);
    });
    
    
})->add($SessionMiddleware); 