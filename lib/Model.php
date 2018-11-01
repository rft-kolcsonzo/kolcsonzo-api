<?php

class Model {
    protected $db;

    public function __construct( $container ) {
        $this->db = $container->db;
    }

    protected function whereIn( array $values ) {
        return '(' . implode( ',', $values ) . ')';
    }
}
