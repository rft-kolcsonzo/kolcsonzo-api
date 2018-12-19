<?php

require_once 'models/OrderModel.php';

class Order
{
    protected $model;

    public function __construct($container)
    {
        $this->model = new OrderModel($container);
    }

    public function createOrder($datas)
    {
        if (!$datas) {
            throw new ValidationException(null, 'Nincs adat');
        }

        if (!isset($datas['car_id']) || !$datas['car_id']) {
            throw new ValidationException('car_id', 'Jármű kiválasztása kötelező!');
        }

        if (!isset($datas['rent_status']) || !$datas['car_id']) {
            $datas['rent_status'] = 1;
        } else {
            $datas['rent_status'] = intval($datas['rent_status']);
            if ($datas['rent_status'] !== 1 && $datas['rent_status'] !== 0) {
                throw new ValidationException('rent_status', 'Nem megfelelő érték bérlés állapotnak!');
            }
        }

        if (!$this->model->isCarFree($datas['car_id'])) {
            throw new ValidationException('car_id', 'Ez az autó már bérbe van adva!');
        }

        if (array_key_exists('end_date', $datas) && !$datas['end_date']) {
            $datas['end_date'] = null;
        }

        return $this->model->insertOrder($datas);
    }

    public function updateOrder($orderId, $datas)
    {
        if (!$datas) {
            throw new ValidationException(null, 'Nincs adat');
        }

        if (!isset($datas['car_id']) || !$datas['car_id']) {
            throw new ValidationException('car_id', 'Jármű kiválasztása kötelező!');
        }

        if (!isset($datas['rent_status']) || !$datas['car_id']) {
            $datas['rent_status'] = 1;
        } else {
            $datas['rent_status'] = intval($datas['rent_status']);
            if ($datas['rent_status'] !== 1 && $datas['rent_status'] !== 0) {
                throw new ValidationException('rent_status', 'Nem megfelelő érték bérlés állapotnak!');
            }
        }

        if (!$this->model->isCarFree($datas['car_id'], $orderId)) {
            throw new ValidationException('car_id', 'Ez az autó már bérbe van adva!');
        }

        if (array_key_exists('end_date', $datas) && !$datas['end_date']) {
            $datas['end_date'] = null;
        }

        return $this->model->updateOrder($orderId, $datas);
    }

}
