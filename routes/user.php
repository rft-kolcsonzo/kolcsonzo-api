<?php

$app->group('/users', function (){
    // GET /users
    $this->get('', function ($request, $response) {
        $session = $request->getAttribute('session');

        $users = $this->userModel->getAll();

        return $response->withJson($users);
    });

    // GET /users/{userId}
    $this->get('/[{userId}]', function ($request, $response, $args) {
        $userId = $args['userId'];

        if ($user = $this->userModel->getUserById($userId)) {
            
            return $response->withJson($user);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen felhasználó!' ], 404);
    });

    $this->post('/', function ($request, $response) {

        $datas = $request->getParsedBody();
        $response = $this->User->insertUser($datas);
        return $this->response->withJson(['message' => $response]);
    });

    $this->post('/login', function ($request, $response, $args) {
        $datas = ($_POST);
        $input = $request->getParsedBody();

        $answer = $this->User->login($datas);
        
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

    $this->delete('/[{userId}]', function ($request, $response, $args) {
        $id = $args['userId'];

        if ($this->userModel->deleteUser($id)) {
            return $this->response->withJson(['message' => 'Sikeres törlés']);
        }

        return $this->response->withJson(['message' => 'Hiba történt']);
    });

    $this->put('/[{id}]', function ($request, $response, $args) {
        $datas = $request->getParsedBody();
        $id = $args['id'];
        $response = $this->User->updateUser($id, $datas);
        return $this->response->withJson(['message' => $response]);
    });

})->add($SessionMiddleware); // Use SessionMiddleware
