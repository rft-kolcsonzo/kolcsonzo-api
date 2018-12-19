<?php

$app->group('/auth', function () {
    $this->post('/token', function ($request, $response, $args) {
        $input = $request->getParsedBody();

        $answer = $this->User->login($input);
        if ($answer) {
            $insertId = $this->userModel->insertToken([
                'access_token' => $answer['access_token'],
                'user_id' => $answer['user_id'],
            ]);
            
            $insertedData = $this->userModel->getTokenData($insertId);

            return $response->withJson([
                'type'  => 'Bearer',
                'is_admin' => $answer['is_admin'],
                'token' => $insertedData['access_token'],
                'created_time' => $insertedData['created_at']
            ]);
        } else {
            return $response->withJson([ 'message' => 'Érvénytelen belépési adatok!' ], 404 );
        }
    });

     $this->get('/token/{hash}', function ($request, $response, $args) {
        $answer = $this->userModel->getByToken($args['hash']);
        
        if ($answer) {

            return $response->withJson([
                $answer
            ]);

        } else {
            return $response->withJson([ 'message' => 'Nincs ilyen token' ], 404 );
        }

    });
});