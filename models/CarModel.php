<?php

class CarModel extends Model
{
    
    //Mintakód
    /*
    public function get($product_id)
    {
        return $this->db
            ->select([
                'p.product_id', 'p.reference_id', 'p.warranty', 'p.bulb', 'p.width', 'p.height', 'p.shipping_info AS shipping_weeks', 'IF(p.available_again != "" AND p.available_again != "0:00:00", CAST(UNIX_TIMESTAMP(p.available_again) AS UNSIGNED), NULL) as available_again', 'p.sample AS available_at_szekszard', 'p.bp_store as available_at_budapest',
            ])
            ->from( 'product p' )
            ->leftJoin( 'product_attribute pa', 'pa.reference_id = p.reference_id AND pa.attr_deleted = 0' )
            ->join( 'product_lang pl', 'pl.product_id', '=', 'p.product_id' )
            ->where( 'p.deleted', '=', 0 )
            ->where( 'p.available_for_order', '=', 1 )
            ->where( 'p.deleted', '=', 0 )
            ->where( 'p.product_id', '=', $product_id )
            ->execute()
            ->fetch();
    }

    public function getAll()
    {
        $bindings = [];
        $fields = [
            'DISTINCT p.product_id', 'p.reference_id', 'p.warranty', 'p.bulb', 'p.width', 'p.height', 'p.shipping_info', 'IF(p.available_again != "" AND p.available_again != "0:00:00", CAST(UNIX_TIMESTAMP(p.available_again) AS UNSIGNED), NULL) as available_again', 'p.sample AS available_at_szekszard', 'p.bp_store as available_at_budapest',
            'CAST( ROUND(IF(pa.product_attribute_id IS NULL,p.price,pa.price)*1.27/10)*10 as UNSIGNED) AS price',
            'CAST( ROUND(IF(pa.product_attribute_id IS NULL,p.original_price,pa.original_price)*1.27/10)*10 as UNSIGNED) AS original_price',
            'IF( (pa.product_attribute_id IS NULL AND p.price < p.original_price) OR (pa.product_attribute_id IS NOT NULL AND pa.price < pa.original_price) , 1, 0 ) AS discounted',
            'IF(pa.product_attribute_id IS NULL,p.image,pa.image) AS image',
            'IF(pa.product_attribute_id IS NULL,p.quantity,pa.quantity) AS quantity',
            'pl.name as name'
        ];

        $stmt = $this->db->prepare("
        SELECT
        " . implode(',', $fields) . "
        FROM product p
        LEFT JOIN product_attribute pa ON pa.reference_id = p.reference_id AND pa.attr_deleted = 0
        LEFT JOIN product_group pg ON pg.product_id = p.product_id
        JOIN product_lang pl ON p.product_id = pl.product_id
        JOIN manufacturer m ON m.manufacturer_id = p.manufacturer_id
        WHERE
            p.public = 1 AND
            p.available_for_order = 1 AND
            p.deleted = 0 AND
            (pg.group_id IS NULL or pg.group_id = -1) AND
            ((pa.product_attribute_id IS NULL and p.price > 0) OR (pa.product_attribute_id IS NOT NULL AND pa.price > 0))
        ");

        $stmt->execute($bindings);

        return $stmt->fetchAll();
    }

    public function getAllIn($ids)
    {
        return $this->db
            ->select([
                'DISTINCT p.product_id', 'p.reference_id', 'p.warranty', 'p.bulb', 'p.width', 'p.height', 'p.shipping_info AS shipping_weeks', 'IF(p.available_again != "" AND p.available_again != "0:00:00", CAST(UNIX_TIMESTAMP(p.available_again) AS UNSIGNED), NULL) as available_again', 'p.sample AS available_at_szekszard', 'p.bp_store as available_at_budapest',
                'CAST( ROUND(IF(pa.product_attribute_id IS NULL,p.price,pa.price)/10)*10 as UNSIGNED) AS net_price',
                'CAST( ROUND(IF(pa.product_attribute_id IS NULL,p.price,pa.price)*1.27/10)*10 as UNSIGNED) AS price',
                'CAST( ROUND(IF(pa.product_attribute_id IS NULL,p.original_price,pa.original_price)*1.27/10)*10 as UNSIGNED) AS original_price',
                'IF( (pa.product_attribute_id IS NULL AND p.price < p.original_price) OR (pa.product_attribute_id IS NOT NULL AND pa.price < pa.original_price) , 1, 0 ) AS discounted',
                'IF(pa.product_attribute_id IS NULL,p.image,pa.image) AS image',
                'IF(pa.product_attribute_id IS NULL,p.quantity,pa.quantity) AS quantity',
                'pl.name as name'
            ])
            ->from('product p')
            ->leftJoin('product_attribute pa', 'pa.reference_id = p.reference_id AND pa.attr_deleted = 0')
            ->join('product_lang pl', 'pl.product_id', '=', 'p.product_id')
            ->whereIn('p.product_id', $ids)
            ->execute()
            ->fetchAll();
    }
    */
}
