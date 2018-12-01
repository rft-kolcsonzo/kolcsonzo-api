<?php
class UserModel extends Model
{
    
    public function getAll()
    {
        return $this->db->select()
                        ->from('users u')
                        ->where('u.enabled_status', '=', 1)
                        ->execute()
                        ->fetchAll();
    }

    public function getUserById($id)
    {
        return $this->db->select()
                        ->from('users u')
                        ->where('u.user_id', '=', $id)
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
        return $this->db->delete()
                        ->from('users')
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

}
