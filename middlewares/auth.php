<?php

class AuthenticationMiddleware
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __invoke($request, $response, $next)
    {
        $token = null;
        if ($request->hasHeader('Authorization')) {
            list($type, $token) = explode(' ', $request->getHeader('Authorization')[0]);
        } elseif ($accessToken = $request->getQueryParam('access_token')) {
            $token = $accessToken;
        }

        if ($token) {
            $result = $this->model->getByToken($token);
            if (!$result) {
                return $response->withJson(['message' => 'Hozzáférés nem engedélyezett!'], 403);
            } else {
                $user = $this->model->getUserById($result['user_id']);

                $request = $request->withAttribute('user', $user);

                return $next($request, $response);
            }
        } else {
            return $response->withJson(['message' => 'Hiányzó Token!'], 401);
        }
    }
}
