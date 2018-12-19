<?php

$app->group('/users', function () {
    // GET /users
    $this->get('', function ($request, $response) {

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

    $this->post('', function ($request, $response) {

        if (!$request->getAttribute('is_admin')) {
            return $response->withJson([ 'message' => 'Nincs joga ehhez a művelethez!' ], 403);
        }
        $datas = $request->getParsedBody();
        try {
            $userId = $this->User->insertUser($datas);
        } catch (ValidationException $e) {
            return $response->withJson(['field' => $e->getField(), 'message' => $e->getMessage()], 406);
        }

        $user = $this->userModel->getUserById($response);
        
        return $this->response->withJson($user);
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
        try {
            $response = $this->User->updateUser($id, $datas);
        } catch (ValidationException $e) {
            return $response->withJson(['field' => $e->getField(), 'message' => $e->getMessage()], 406);
        }
        
        $user = $this->userModel->getUserById($id);

        return $this->response->withJson($user);
    });

})->add($AuthenticationMiddleware); // Use SessionMiddleware
