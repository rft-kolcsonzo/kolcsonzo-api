<?php
class UserModel extends Model
{
    
    public function getAll()
    {
        return $this->db->select()
                        ->from('users u')
                        ->where('u.enabled_status', '=', 1)
                        ->execute()
                        ->fetch();
    }

    public function getUserById($id)
    {
        return $this->db->select()
                        ->from('users u')
                        ->where('u.user_id', '=', $id)
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
        return $this->db->update($datas)
                        ->table('users')
                        ->where('user_id', '=', $id)
                        ->execute();
    }
}
