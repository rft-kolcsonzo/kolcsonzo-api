<?php
class UserModel extends Model
{
    
    public function getAll()
    {
        return $this->db->select(array('user_id','email','firstname', 'lastname', 'profile_img','is_admin'))
                        ->from('users u')
                        ->where('u.enabled_status', '=', 1)
                        ->where('u.deleted', '=', 0)
                        ->execute()
                        ->fetchAll();
    }

    public function getUserById($id)
    {
        return $this->db->select(array('user_id','email','firstname', 'lastname', 'profile_img','is_admin'))
                        ->from('users u')
                        ->where('u.user_id', '=', $id)
                        ->where('u.enabled_status', '=', 1)
                        ->where('u.deleted', '=', 0)
                        ->execute()
                        ->fetch();
    }

    public function getUser($field, $data)
    {
        return $this->db->select()
                        ->from('users u')
                        ->where('u.'.$field, '=', $data)
                        ->execute()
                        ->fetch();
    }

    public function insertUser($datas)
    {       
        return $this->db->insert($datas)
                        ->into('users')
                        ->execute();
    }

    public function deleteUser($id)
    {
        return $this->db->update(array('deleted' => 1))
                    ->table('users')
                    ->where('user_id', '=', $id)
                    ->execute();
    }

    public function updateUser($id, $datas)
    {
        $this->db->update($datas)
                        ->table('users')
                        ->where('user_id', '=', $id)
                        ->execute();
        return $id;
                        
    }

    public function login($email, $password)
    {
        return $this->db->select()
                        ->from('users u')
                        ->where('u.email', '=', $email)
                        ->where('u.password', '=', $password)
                        ->where('u.enabled_status', '=', 1)
                        ->where('u.deleted', '=', 0)
                        ->execute()
                        ->fetch();
    }

    public function insertToken($datas)
    {       
        return $this->db->insert($datas)
                        ->into('sessions')
                        ->execute();
    }

    public function getTokenData($id)
    {
        return $this->db->select()
                        ->from('sessions s')
                        ->where('s.session_id', '=', $id)
                        ->execute()
                        ->fetch();
    }

    public function getByToken($token)
    {
        $id = $this->db
            ->select(array('user_id'))
            ->from( 'sessions' )
            ->where( 'access_token', '=', $token['token'] )
            ->execute()
            ->fetch();
        
        return $this->db->select(array('is_admin'))
                        ->from('users u')
                        ->where('u.user_id', '=', $id['user_id'])
                        ->where('u.enabled_status', '=', 1)
                        ->where('u.deleted', '=', 0)
                        ->execute()
                        ->fetch();
        

    }

}
