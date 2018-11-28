<?php

require_once 'models/UserModel.php';

class User
{    
    protected $model;

    public function __construct($container)
    {
        $this->model = new UserModel($container);
    }

    public function insertUser($datas)
    {
        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (!isset($datas['email']) || !$datas['email']) {
                    throw new Exception('Az email mező kötelező');
                }

                if (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('Az email cím formátuma nem megfelelő');
                }

                if (!isset($datas['password']) || !$datas['password']) {
                    throw new Exception('A jelszó mező kötelező');
                }

                if (!isset($datas['firstname']) || !$datas['firstname']) {
                    throw new Exception('A vezetéknév mező kötelező');
                }

                if (!isset($datas['lastname']) || !$datas['lastname']) {
                    throw new Exception('Az utónév mező kötelező');
                }

                if ($this->model->getUser('email', $datas['email'])) {
                    throw new Exception('Ez az email cím már foglalt');
                }
            

            $datas['password'] = sha1($datas['password']);

            return $this->model->insertUser($datas);
                
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }

    public function login($datas)
    {
        $email = $datas['user_email'];
        $password = sha1($datas['password']);

        if (($user = $this->model->login($email, $password))) {
            return array(
                'access_token' => bin2hex(random_bytes(30)),
                'user_id' => $user['user_id']
            );     
        } else {
            return false;
        }

    }

    public function updateUser($id, $datas)
    {

        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (isset($datas['email']) && !$datas['email']) {
                    throw new Exception('Az email mező kötelező');
                }

                if (isset($datas['email']) && $datas['email'] && !filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('Az email cím formátuma nem megfelelő');
                }

                if (isset($datas['password']) && !$datas['password']) {
                    throw new Exception('A jelszó mező kötelező');
                } else if (isset($datas['password']) && $datas['password']) {
                    $datas['password'] = sha1($datas['password']);
                }

                if (isset($datas['firstname']) && !$datas['firstname']) {
                    throw new Exception('A vezetéknév mező kötelező');
                }

                if (isset($datas['lastname']) && !$datas['lastname']) {
                    throw new Exception('Az utónév mező kötelező');
                }

                return $this->model->updateUser($id, $datas);
                  
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }
}