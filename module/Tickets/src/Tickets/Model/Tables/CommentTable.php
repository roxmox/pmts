<?php

namespace Tickets\Model\Tables;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

class CommentTable 
{
    protected $_tableGateway;
    
    public function __construct(TableGateway $tableGateway) 
    {
        $this->_tableGateway = $tableGateway;
    }
         
    
    public function getCommentsByTicketId($id)
    {
       $data = array();
       if($id != null) {
           $sql = new Sql($this->_tableGateway->getAdapter()); 
           
           $select = $sql->select();
           $select->from('tks_comments')
                  ->join('users', 'tks_comments.creator_id = users.id',array('firstname', 'lastname'));
           
           $where = new  Where();
           $where->equalTo('ticket_id', $id) ;
           
           $select->where($where);
           $statement = $sql->prepareStatementForSqlObject($select);
           
           $resultSet = $statement->execute();
                
           foreach($resultSet AS $val){
               $data[] = $val;
           }
           return $data;
        }else{
            throw new \Exception('Ticket ID IS NULL');
        }
    }
    
    public function insert(Array $data)
    {
        return $this->_tableGateway->insert($data);
    }
    
    public function update(Array $data)
    {
        $id = (int)$data['id'];
        if($id != null){
            return $this->_tableGateway->update($data, array('id' => $id));
        } else {
            throw new \Exception('UPDATE ID IS NULL');
        }
    }
    
    public function delete($id)
    {
        $id = (int)$id;
        if($id != null){
            return $this->_tableGateway->delete(array('id' => $id));
        } else {
            throw new \Exception('DELETE ID IS NULL');
        }
    }
}