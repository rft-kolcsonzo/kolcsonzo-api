<?php

require_once 'models/ServiceModel.php';

class Service
{    
    protected $model;

    public function __construct($container)
    {
        $this->model = new ServiceModel($container);
    }

    public function insertService($datas)
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

                if (!isset($datas['need_to_fix']) || !$datas['need_to_fix']) {
                    throw new Exception('A javítás szükséges-e mező kötelező');
                }

                if (!isset($datas['ready_to_work']) || !$datas['ready_to_work']) {
                    throw new Exception('A szervíz kész url mező kötelező');
                }
            
            return $this->model->insertService($datas);
                
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }

    public function updateService($id, $datas)
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

            if (!isset($datas['need_to_fix']) || !$datas['need_to_fix']) {
                throw new Exception('A javítás szükséges-e mező kötelező');
            }

            if (!isset($datas['ready_to_work']) || !$datas['ready_to_work']) {
                throw new Exception('A szervíz kész url mező kötelező');
            }
        
        return $this->model->updateService($datas);
            
        
    } catch (Exception $e) {
       return $e->getMessage();
    }
    }
}