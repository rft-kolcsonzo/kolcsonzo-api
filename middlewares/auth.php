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
        }
        
        if ($token) {
            $result = $this->model->getByToken($token);
            if (!$result) {
                return $response->withJson([ 'message' => 'Nem létező munkamenet az X-Session-Token headerben!' ], 412);
            } else {
                $is_admin = $this->model->getUserById($result['user_id']);
                
                $request = $request->withAttribute('is_admin', $is_admin['is_admin']);
                
                return $next($request, $response);
                
            }
        } else {
            return $response->withJson([ 'message' => 'Hiányzó Token!' ], 412 );
        }
    }
}
