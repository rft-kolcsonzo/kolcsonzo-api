<?php

require_once 'models/ImageModel.php';

class Image
{    
    protected $model;

    public function __construct($container)
    {
        $this->model = new ImageModel($container);
    }

    public function insertImage($datas)
    {
        try {
                if (!$datas) {
                    throw new Exception('Nincs adat');
                }

                if (!isset($datas['filename']) || !$datas['filename']) {
                    throw new Exception('A fájl név mező kötelező');
                }

                if (!isset($datas['pathdir']) || !$datas['pathdir']) {
                    throw new Exception('Az elérési könyvtár mező kötelező');
                }

                if (!isset($datas['pathurl']) || !$datas['pathurl']) {
                    throw new Exception('Az elérési url mező kötelező');
                }
            
            return $this->model->insertImage($datas);
                
            
        } catch (Exception $e) {
           return $e->getMessage();
        }
    }

    public function updateImage($id, $datas)
    {

        try {
            if (!$datas) {
                throw new Exception('Nincs adat');
            }

            if (!isset($datas['filename']) || !$datas['filename']) {
                throw new Exception('A fájl név mező kötelező');
            }

            if (!isset($datas['pathdir']) || !$datas['pathdir']) {
                throw new Exception('Az elérési könyvtár mező kötelező');
            }

            if (!isset($datas['pathurl']) || !$datas['pathurl']) {
                throw new Exception('Az elérési url mező kötelező');
            }
        
        return $this->model->updateImage($datas);
            
        
    } catch (Exception $e) {
       return $e->getMessage();
    }
    }
}