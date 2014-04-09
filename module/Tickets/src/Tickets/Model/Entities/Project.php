<?php

namespace Tickets\Model\Entities;

class Project
{
    public $id = null;
    public $project = null;
    public $online = null;
    public $color = null;
    
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id']) ? $data['id'] : '');
        $this->project = (isset($data['project']) ? $data['project'] : '');
        $this->online = (isset($data['online']) ? $data['online'] : '');
        $this->color = (isset($data['color']) ? $data['color'] : '');
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
