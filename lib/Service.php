<?php

require_once 'models/ServiceModel.php';

class Service
{    
    protected $model;

    public function __construct($container)
    {
        $this->model = new ServiceModel($container);
    }

    public function validService($id, $datas, $method)
    {
        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (!isset($datas['service_date']) || !$datas['service_date']) {
                    throw new Exception('A szervíz dátum mező kötelező');
                }

                if (!isset($datas['runned_km']) || !$datas['runned_km']) {
                    throw new Exception('A ment kilóméterek mező kötelező');
                }

                if (!isset($datas['need_to_fix'])){
                    throw new Exception('A javítás szükséges-e mező kötelező');
                }

                if ($datas['need_to_fix'] > 1 || $datas['need_to_fix'] < 0) {
                    throw new Exception('A javítás szükséges-e mezőben érvénytelen érték van');
                }

                if (!isset($datas['ready_to_work'])) {
                    throw new Exception('A szervíz kész url mező kötelező');
                }

                if ($datas['ready_to_work'] > 1|| $datas['ready_to_work'] < 0) {
                    throw new Exception('A szervíz kész url mezőben érvénytelen érték');
                }
            
                if($method)
                    return $this->model->insertCarService($datas);
                else    
                    return $this->model->updateCarService($id, $datas);
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }
}