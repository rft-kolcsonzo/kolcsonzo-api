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
        if (!$datas) {
            throw new ValidationException(null, 'Nincs adat');
        }

        if (!isset($datas['email']) || !$datas['email']) {
            throw new ValidationException('email', 'Az email mező kötelező');
        }

        if (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('email', 'Az email cím formátuma nem megfelelő');
        }

        if (!isset($datas['password']) || !$datas['password']) {
            throw new ValidationException('password', 'A jelszó mező kötelező');
        }

        if (!isset($datas['firstname']) || !$datas['firstname']) {
            throw new ValidationException('firstname', 'A vezetéknév mező kötelező');
        }

        if (!isset($datas['lastname']) || !$datas['lastname']) {
            throw new ValidationException('lastname', 'Az utónév mező kötelező');
        }

        if ($this->model->getUser('email', $datas['email'])) {
            throw new ValidationException('email', 'Ez az email cím már foglalt');
        }

        if (isset($datas['is_admin'])) {
            $datas['is_admin'] = filter_var($datas['is_admin'], FILTER_VALIDATE_BOOLEAN);
        } else {
            $datas['is_admin'] = false;
        }

        $datas['password'] = sha1($datas['password']);

        return $this->model->insertUser($datas);
    }

    public function login($datas)
    {
        $email = $datas['email'];
        $password = sha1($datas['password']);

        if (($user = $this->model->login($email, $password))) {
            return array(
                'access_token' => bin2hex(random_bytes(30)),
                'user_id' => $user['user_id'],
                'is_admin' => !!$user['is_admin'],
            );
        } else {
            return false;
        }

    }

    public function updateUser($id, $datas)
    {
        if (!$datas) {
            throw new ValidationException(null, 'Nincs adat');
        }

        if (isset($datas['email']) && !$datas['email']) {
            throw new ValidationException('email', 'Az email mező kötelező');
        }

        if (isset($datas['email']) && $datas['email'] && !filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('email', 'Az email cím formátuma nem megfelelő');
        }

        if (isset($datas['password']) && $datas['password']) {
            $datas['password'] = sha1($datas['password']);
        } else {
            unset($datas['password']);
        }

        if (isset($datas['firstname']) && !$datas['firstname']) {
            throw new ValidationException('firstname', 'A vezetéknév mező kötelező');
        }

        if (isset($datas['lastname']) && !$datas['lastname']) {
            throw new ValidationException('lastname', 'Az utónév mező kötelező');
        }

        if (isset($datas['is_admin']) && !!$datas['is_admin']) {
            $datas['is_admin'] = true;
        } else {
            $datas['is_admin'] = false;
        }

        return $this->model->updateUser($id, $datas);
    }
}
