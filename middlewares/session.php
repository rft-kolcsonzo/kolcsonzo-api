<?php

class SessionMiddleware
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __invoke($request, $response, $next)
    {
        $token = null;
        if ($request->hasHeader('X-Session-Token')) {
            $token = $request->getHeader('X-Session-Token')[0];
        } elseif ($request->hasHeader('Authorization')) {
            list($type, $token) = explode(' ', $request->getHeader('Authorization')[0]);
        }
        
        if ($token) {
            $session = $this->model->getByToken($token, false);
            if (!$session) {
                return $response->withJson([ 'message' => 'Nem létező munkamenet az X-Session-Token headerben!' ], 404);
            }
            $session = (object) $session;

            $request = $request->withAttribute('session', $session);
        }

        return $next($request, $response);
    }
}
