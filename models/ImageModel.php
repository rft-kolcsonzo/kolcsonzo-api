<?php

class ImageModel extends Model
{

    public function getAllCarImages()
    {
        return $this->db->select()
                        ->from('car_images')
                        ->execute()
                        ->fetchAll();
    }

    public function getCarImageById($id)
    {

        return $this->db->select()
                        ->from('car_images c')
                        ->where('c.car_id', '=', $id)
                        ->execute()
                        ->fetch();
    }

    public function insertCarImage($datas)
    {       
        return $this->db->insert($datas)
                        ->into('car_images')
                        ->execute();
    }

    public function deleteCarImage($id)
    {
        return $this->db->delete()
                        ->from('car_images')
                        ->where('car_id', '=', $id)
                        ->execute();
    }

    public function updateCarImage($id, $datas)
    {
        return $this->db->update($datas)
                        ->table('car_images c')
                        ->where('c.car_id', '=', $id)
                        ->execute();
    }
    
    public function getByFilter($field, $keyword)
    {
        return $this->db->select()
                        ->from('car_images')
                        ->where($field, 'like', '%'.$keyword.'%')
                        ->execute()
                        ->fetchAll();
        
    }
}
