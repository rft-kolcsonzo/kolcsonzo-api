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
        $message = 'Sikeres mentés';
        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (!isset($datas['email']) || !$datas['email']) {
                    throw new Exception('Az email mező kötelező');
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
            

            $datas['password'] = md5($datas['password']);

            if ($this->model->insertUser($datas)) {
                return $message;
            }
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }

    public function updateUser($id, $datas)
    {
        $message = 'Sikeres módosítás';

        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (isset($datas['email']) && !$datas['email']) {
                    throw new Exception('Az email mező kötelező');
                }

                if (isset($datas['password']) && !$datas['password']) {
                    throw new Exception('A jelszó mező kötelező');
                } else if (isset($datas['password']) && $datas['password']) {
                    $datas['password'] = md5($datas['password']);
                }

                if (isset($datas['firstname']) && !$datas['firstname']) {
                    throw new Exception('A vezetéknév mező kötelező');
                }

                if (isset($datas['lastname']) && !$datas['lastname']) {
                    throw new Exception('Az utónév mező kötelező');
                }

                if ($this->model->updateUser($id, $datas)) {
                    return $message;
                } else {
                    return 'Ez az adat már szerepel az adatbázisban';
                }
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }
}