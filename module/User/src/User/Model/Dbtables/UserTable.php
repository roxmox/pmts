<?php
namespace User\Model\Dbtables;

use Zend\Db\TableGateway\TableGateway;

class UserTable 
{
    protected $_tableGateway;
    protected $_userPass;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->_tableGateway = $tableGateway;
    }
            
    public function getFormArray()
    {
        $users = $this->getAllUser();
        
        foreach($users AS $user){
            $data[$user->id] = $user->firstname.' '.$user->lastname;
        }
        return $data;
    }
    
    public function getAllUser()
    {
        $resultset = $this->_tableGateway->select();
        
        foreach($resultset AS $result){
            $users[] = $result;
        }
        
        return $users;
    }
    
    public function setPass($pass)
    {
        $this->_userPass = $pass;
    }
    
    public function getPass()
    {
        return $this->_userPass;
    }
        
    
    public function getUserByEmail($email)
    {
        if($email != ''){
            $rowset = $this->_tableGateway->select(array('email' => $email));
            $row = $rowset->current();
            if(!$row){
                return false;
            }
            $this->setPass($row->password);
            return $row;
        }else{
            throw new \Exception('Email is empty');
        }
    }
    
    public function getById($id)
    {
        if($id != 0){
            $rowset = $this->_tableGateway->select(array('id' => (int)$id));
            $row = $rowset->current();
            if(!$row){
                return false;
            }
            return $row;
        }else{
            throw new \Exception('id is empty');
        }
    }
       
    public function saveUser($data)
    {
        $this->_tableGateway->insert($data);
        
        return $this->_tableGateway->getLastInsertValue();
    }
    
    public function updateUser($data)
    {
        if($data['id'] != 0){
            $id = (int)$data['id'];
            $this->_tableGateway->update($data, array('id' => $id));
        } else {
            throw new \Exception('ID IS NULL');
        }
    }
        
    public function delete($id)
    {
         $this->_tableGateway->delete(array('id' => $id));
    }
      
}
