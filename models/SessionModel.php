<?php

class SessionModel extends Model
{
    public function getByToken($token)
    {
        return $this->db
            ->select()
            ->from( 'sessions' )
            ->where( 'access_token', '=', $token )
            ->execute()
            ->fetch();
    }

    public function getUserById($id)
    {
        return $this->db
            ->select(array('is_admin'))
            ->from( 'users' )
            ->where( 'user_id', '=', $id )
            ->execute()
            ->fetch();
    }

    public function create($data)
    {
        return $this->db->insert( array_keys( $data ) )
                ->into( 'sessions' )
                ->values( array_values( $data ) )
                ->execute();
    }
}
