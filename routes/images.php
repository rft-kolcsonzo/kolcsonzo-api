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
	    
    $this->get('/{imageId}', function ($request, $response, $args) {	 

        $imageId = $args['imageId'];	 

        if (!$session = $request->getAttribute('session')) {	

            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);	           
        }	        

        if ($carImage = $this->imageModel->getCarImageById($imageId)) {	       
         
            return $response->withJson($carImage);	          
        }	        

        return $response->withJson([ 'message' => 'Nem létezik ilyen kép!' ], 404);	       
    });	  
    
    $this->post('/insert', function ($request, $response) {
        
        $datas = $request->getParsedBody();
        $response = $this->imageModel->insertCarImage($datas);

        return $this->response->withJson(['message' => $response]);
    });

    $this->delete('/[{imageId}]', function ($request, $response, $args) {

        $imageId = $args['imageId'];

        if ($this->imageModel->deleteCarImage($imageId)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    }); 

    $this->put('/[{imageId}]', function ($request, $response, $args) {

        $datas = $request->getParsedBody();
        $imageId = $args['imageId'];
        $response = $this->imageModel->updateCarImage($imageId, $datas);

        return $this->response->withJson(['message' => $response]);
    });
    
    
})->add($SessionMiddleware); 