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

        if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }

        if ($user = $this->userModel->getUserById($userId)) {
            
            return $response->withJson($user);
        }

        return $response->withJson([ 'message' => 'Nem létezik ilyen felhasználó!' ], 404);
    });

    $this->post('/insert', function ($request, $response) {
        
        /*if (!$session = $request->getAttribute('session')) {
            return $response->withJson([ 'message' => 'Csak aktív munkafolyamatban érhető el ez a metódus!' ], 412);
        }*/

        $datas = $request->getParsedBody();
        $response = $this->User->insertUser($datas);
        return $this->response->withJson(['message' => $response]);
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
