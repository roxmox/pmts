<?php
namespace Tickets\Model\Tables;

use Zend\Db\TableGateway\TableGateway;

class DepartmentTable
{
    protected $_tableGateway = null;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->_tableGateway = $tableGateway;
    }
    
    public function getFormArray()
    {
        $resultset = $this->_tableGateway->select();
        
        foreach($resultset AS $result){
            $data[$result->id] = $result->department;
        }
        
       return $data;
    }
    
    public function getById($id)
    {
        if($id != 0){
            $resultSet = $this->_tableGateway->select(array('id' => (int)$id));
            return $resultSet->current();
        }else{
            throw new \Exception('ID IS NULL: DepartmentTable');
        }
    }
}

