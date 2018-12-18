<?php

require_once 'models/CarModel.php';

class Car
{    
    protected $model;

    public function __construct($container)
    {
        $this->model = new CarModel($container);
    }

    public function validCar($id, $datas, $method)
    {
        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (!isset($datas['plate_number']) || !$datas['plate_number']) {
                    throw new Exception('A rendszám mező kötelező');
                }

                if (!isset($datas['modell']) || !$datas['modell']) {
                    throw new Exception('A model mező kötelező');
                }

                if (!isset($datas['persons']) || !$datas['persons']) {
                    throw new Exception('A személyek száma mező kötelező');
                }

                if (!isset($datas['doors_number']) || !$datas['doors_number']) {
                    throw new Exception('Az ajtók száma mező kötelező');
                }

                if (!isset($datas['category']) || !$datas['category']) {
                    throw new Exception('A kategória mező kötelező');
                }

                if (!isset($datas['tags']) || !$datas['tags']) {
                    throw new Exception('A tag mező kötelező');
                }

                if (!isset($datas['born_date']) || !$datas['born_date']) {
                    throw new Exception('A gyártási év mező kötelező');
                }

                if (!isset($datas['insurance_name']) || !$datas['insurance_name']) {
                    throw new Exception('A biztosítás neve mező kötelező');
                }

                if (!isset($datas['insurance_until_date']) || !$datas['insurance_until_date']) {
                    throw new Exception('A biztosítás lejárata mező kötelező');
                }

                if (!isset($datas['available_status'])) {
                    throw new Exception('A kocsi elérhetősége mező kötelező');
                }

                if ($datas['available_status'] > 1 || $datas['available_status'] < 0 ) {
                    throw new Exception('A kocsi elérhetősége mező érvénytelen adatot kapott');
                }
            
                if($method)
                    return $this->model->insertCar($datas);
                else    
                    return $this->model->updateCar($id, $datas);
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }

}