<?php

class ValidationException extends RuntimeException
{
    protected $field;

    public function __construct($field, $message = '')
    {
        parent::__construct($message);

        $this->field = $field;
    }

    public function getField()
    {
        return $this->field;
    }
}