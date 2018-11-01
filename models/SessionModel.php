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

    public function create($data)
    {
        return $this->db->insert( array_keys( $data ) )
                ->into( 'sessions' )
                ->values( array_values( $data ) )
                ->execute();
    }
}
