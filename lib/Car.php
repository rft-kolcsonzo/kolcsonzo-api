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
        if (!$datas) {
            throw new ValidationException(null, 'Nincs adat');
        }

        if (!isset($datas['plate_number']) || !$datas['plate_number']) {
            throw new ValidationException('plate_number', 'A rendszám mező kötelező');
        }

        if (!isset($datas['modell']) || !$datas['modell']) {
            throw new ValidationException('modell', 'A model mező kötelező');
        }

        if (!isset($datas['persons']) || !$datas['persons']) {
            throw new ValidationException('persons', 'A személyek száma mező kötelező');
        }

        if (!isset($datas['doors_number']) || !$datas['doors_number']) {
            throw new ValidationException('doors_number', 'Az ajtók száma mező kötelező');
        }

        if (!isset($datas['category']) || !$datas['category']) {
            throw new ValidationException('category', 'A kategória mező kötelező');
        }

        if (!isset($datas['born_date']) || !$datas['born_date']) {
            throw new ValidationException('born_date', 'A gyártási év mező kötelező');
        }

        if (!isset($datas['insurance_name']) || !$datas['insurance_name']) {
            throw new ValidationException('insurance_name', 'A biztosítás neve mező kötelező');
        }

        if (!isset($datas['insurance_until_date']) || !$datas['insurance_until_date']) {
            throw new ValidationException('insurance_until_date', 'A biztosítás lejárata mező kötelező');
        }

        if (!isset($datas['available_status'])) {
            throw new ValidationException('available_status', 'A kocsi elérhetősége mező kötelező');
        }

        if (isset($datas['available_status']) && !!$datas['available_status']) {
            $datas['available_status'] = true;
        } else {
            $datas['available_status'] = false;
        }
    
        if (!$id) {
            return $this->model->insertCar($datas);
        } else {
            return $this->model->updateCar($id, $datas);
        }
    }

}