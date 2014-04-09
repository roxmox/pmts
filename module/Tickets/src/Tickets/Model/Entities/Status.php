<?php

namespace Tickets\Model\Entities;

class Status
{
    public $id = null;
    public $status = null;
    public $color = null;
    
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id']) ? $data['id'] : '');
        $this->status = (isset($data['status']) ? $data['status'] : '');
        $this->color = (isset($data['color']) ? $data['color'] : '');
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

