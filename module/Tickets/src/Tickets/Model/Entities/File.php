<?php
namespace Tickets\Model\Entities;

class File
{
    public $id = null;
    public $ticket_id = null;
    public $file = null;
    public $date = null;
    
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id']) ? $data['id'] : '');
        $this->ticket_id = (isset($data['ticket_id']) ? $data['ticket_id'] : '');
        $this->file = (isset($data['file']) ? $data['file'] : '');
        $this->date = (isset($data['date']) ? $data['date'] : '');
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

