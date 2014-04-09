<?php
namespace User\Model\Entities;

class User
{
    public $id = null;
    public $role = null;
    public $email = null;
    public $password = null;
    public $firstname = null;
    public $lastname = null;
   
    public function exchangeArray(Array $data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->role = (isset($data['role'])) ? $data['role'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->firstname = (isset($data['firstname'])) ? $data['firstname'] : null;
        $this->lastname = (isset($data['lastname'])) ? $data['lastname'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function setPass($pass)
    {
        $this->password = $pass;
    }
    
    public function getPass()
    {
        return $this->password;
    }
    
    public function getRole()
    {
        return $this->role;
    }
}
