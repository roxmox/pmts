<?php

namespace Tickets\Model\Entities;

class Comment 
{
    public $id = null;
    public $comment = null;
    public $creator_id = null;
    public $ticket_id = null;
    public $date = null;
    
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->comment = (isset($data['comment'])) ? $data['comment'] : null;
        $this->creator_id = (isset($data['creator_id'])) ? $data['creator_id'] : null;
        $this->ticket_id = (isset($data['ticket_id'])) ? $data['ticket_id'] : null;
        $this->date = (isset($data['date'])) ? $data['date'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}

