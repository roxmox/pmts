<?php

namespace Tickets\Model\Entities;

class Department
{
    public $id = null;
    public $department = null;
   
    
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id']) ? $data['id'] : '');
        $this->department = (isset($data['department']) ? $data['department'] : '');
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

