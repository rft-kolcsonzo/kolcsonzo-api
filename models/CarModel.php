<?php

class CarModel extends Model
{

    public function getAllCars($filter = [])
    {
        $stmt = $this->db->select()
            ->from('cars')
            ->whereMany($filter, '=');

        return $stmt->execute()
            ->fetchAll();
    }

    public function getCarById($id)
    {

        return $this->db->select()
            ->from('cars c')
            ->where('c.car_id', '=', $id)
            ->execute()
            ->fetch();
    }

    public function insertCar($datas)
    {
        return $this->db->insert($datas)
            ->into('cars')
            ->execute();
    }

    public function deleteCar($id)
    {
        return $this->db->delete()
            ->from('cars')
            ->where('car_id', '=', $id)
            ->execute();
    }

    public function updateCar($id, $datas)
    {
        return $this->db->update($datas)
            ->table('cars c')
            ->where('c.car_id', '=', $id)
            ->execute();
    }

    public function getByFilter($field, $keyword)
    {
        return $this->db->select()
            ->from('cars')
            ->where($field, 'like', '%' . $keyword . '%')
            ->execute()
            ->fetchAll();

    }

}
