<?php

class CarServiceModel extends Model
{

    public function getAllCarServices()
    {
        return $this->db->select()
                        ->from('car_services')
                        ->execute()
                        ->fetch();
    }

    public function geCarServiceById($id)
    {

        return $this->db->select()
                        ->from('car_services c')
                        ->where('c.service_id', '=', $id)
                        ->execute()
                        ->fetch();
    }

    public function insertCarService($datas)
    {       
        return $this->db->insert($datas)
                        ->into('car_services')
                        ->execute()
                        ->fetch();
    }

    public function deleteCarService($id)
    {

        return $this->db->delete()
                        ->from('car_services c')
                        ->where('c.service_id', '=', $id)
                        ->execute()
                        ->fetch();
    }

    public function updateCarService($id, $datas)
    {

        return $this->db->update($datas)
                        ->table('car_services c')
                        ->where('c.service_id', '=', $id)
                        ->execute()
                        ->fetch();
    }
    //soon
    public function getByFilter($field, $keyword)
    {
        return $this->db->select()
                        ->from('car_services')
                        ->where($field, 'like', '%'.$keyword.'%')
                        ->execute()
                        ->fetch();
        
    }
}
