<?php

class ServiceModel extends Model
{

    public function getAllCarServices()
    {
        return $this->db->select()
                        ->from('car_services')
                        ->execute()
                        ->fetchAll();
    }

    public function getCarServiceById($id)
    {

        return $this->db->select()
                        ->from('car_services c')
                        ->where('c.car_id', '=', $id)
                        ->execute()
                        ->fetch();
    }

    public function insertCarService($datas)
    {       
        return $this->db->insert($datas)
                        ->into('car_services')
                        ->execute();
    }

    public function deleteCarService($id)
    {

        return $this->db->delete()
                        ->from('car_services')
                        ->where('car_id', '=', $id)
                        ->execute();
    }

    public function updateCarService($id, $datas)
    {

        return $this->db->update($datas)
                        ->table('car_services c')
                        ->where('c.car_id', '=', $id)
                        ->execute();
    }
    
    public function getByFilter($field, $keyword)
    {
        return $this->db->select()
                        ->from('car_services')
                        ->where($field, 'like', '%'.$keyword.'%')
                        ->execute()
                        ->fetchAll();
        
    }
}
