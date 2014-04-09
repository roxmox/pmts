<?php

namespace Tickets\Model\Entities;

class Prio
{
    public $id = null;
    public $prio = null;
    public $color = null;
    
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id']) ? $data['id'] : '');
        $this->prio = (isset($data['prio']) ? $data['prio'] : '');
        $this->color = (isset($data['color']) ? $data['color'] : '');
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

