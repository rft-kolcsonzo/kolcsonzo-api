<?php

class OrderModel extends Model
{
    
    public function get($order_id)
    {
        return $this->db
            ->select([
                'o.rent_id', 'o.car_id', 'o.start_date', 'o.end_date', 'o.rent_status', 'o.starting_km', 'o.last_km', 'o.accident_details', 'o.daily_rent_price', 'o.fixing_price', 'o.insurance_price', 'o.deposit', 'o.rent_subtotal', 'o.vat', 'o.rent_total', 'o.firstname', 'o.lastname', 'o.user_id', 'o.email', 'o.address', 'o.phone', 'o.birthdate',
            ])
            ->from( 'rent_orders o' )
            ->where( 'o.order_id', '=', $order_id )
            ->execute()
            ->fetch();
    }

    public function getAll()
    {
        return $this->db
            ->select([
                'o.rent_id', 'o.car_id', 'o.start_date', 'o.end_date', 'o.rent_status', 'o.starting_km', 'o.last_km', 'o.accident_details', 'o.daily_rent_price', 'o.fixing_price', 'o.insurance_price', 'o.deposit', 'o.rent_subtotal', 'o.vat', 'o.rent_total', 'o.firstname', 'o.lastname', 'o.user_id', 'o.email', 'o.address', 'o.phone', 'o.birthdate',
            ])
            ->from( 'rent_orders o' )
            ->execute()
            ->fetchAll();
    }

}