<?php

$app->group('/auth', function (){
    $this->post('/login', function ($request, $response, $args) {
        
        $input = $request->getParsedBody();

        $answer = $this->User->login($input);
        
        if ($answer) {

            $insertId = $this->userModel->insertToken($answer);
            
            $insertedData = $this->userModel->getTokenData($insertId);

            return $response->withJson([
                'type'  => 'accessToken',
                'token' => $insertedData['access_token'],
                'created_time' => $insertedData['created_at']
            ]);

        } else {
            return $response->withJson([ 'message' => 'Érvénytelen belépési adatok!' ], 404 );
        }

    });

     $this->post('/token', function ($request, $response, $args) {
        
        $input = $request->getParsedBody();

        $answer = $this->userModel->getByToken($input);
        
        if ($answer) {

            return $response->withJson([
                $answer
            ]);

        } else {
            return $response->withJson([ 'message' => 'Nincs ilyen token' ], 404 );
        }

    });
});