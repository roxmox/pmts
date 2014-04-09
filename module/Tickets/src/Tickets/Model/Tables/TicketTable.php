<?php

namespace Tickets\Model\Tables;

use Zend\Db\TableGateway\TableGateway;

class TicketTable
{
    protected $_tableGateway;
        
    public function __construct(TableGateway $tableGateway)
    {
        $this->_tableGateway = $tableGateway;
    }
    
    
    public function getAllTickets()
    {
        $resultSet = $this->_tableGateway->select();
        return $resultSet;
    }
    
    
    public function getTicketsById(Array $where)
    {
        if(!empty($where)){
            $resultSet = $this->_tableGateway->select($where);
            return $resultSet->toArray();
        }else{
            throw new \Exception('ARRAY IS EMPTY: TicketTable');
        }
    }
    
    public function insert(Array $data)
    {
        if(!empty($data)){
            if($this->_tableGateway->insert($data)){
                return $this->_tableGateway->lastInsertValue;
            }
            return false;
        }else{
            throw new \Exception('DATA ARRAY IS EMPTY: TicketTable');
        }
    }

     public function update($data)
    {
        if($data['id'] != 0){
            if($this->_tableGateway->update($data, array('id' => (int)$data['id']))){
                return true;
            }
            return false;
        } else {
            throw new \Exception('UPDATE ID IS NULL: TicketTable');
        }
    }
        
    public function delete($id)
    {
        if($id != 0){
            if($this->_tableGateway->delete(array('id' => $id))){
                return true;
            }
            return false;
        } else {
            throw new \Exception('DELETE ID IS NULL: TicketTable');
        }
        
    }
}

