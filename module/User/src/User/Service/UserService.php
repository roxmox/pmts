<?php
namespace User\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Session\Container;
use User\Model\Entities\User;
use User\Forms\LoginForm;

class UserService 
{
    protected $_userTable = null;     
    protected $_authentication = null;
    protected $_form;
    protected $_message = null;
    
    public function setMessage($message)
    {
        $this->_message = $message;
    }
    
    public function clearMessage()
    {
        $this->_message = null;
    }
    
    public function getMessage()
    {
        return $this->_message;
    }



    public function setForm(LoginForm $form)
    {
        $this->_form = $form;
        return $this;
    }
    
    public function getForm()
    {
        return $this->_form;
    }
    
    public function setUserTable($table)
    {
        $this->_userTable = $table;
    }
    
    public function getUserTable()
    {
        return $this->_userTable;
    }
    
    public function setAuthentication(AuthenticationService $authentication)
    {
        $this->_authentication = $authentication;
        return $this;
    }
    
    public function getAuthentication()
    {
        return $this->_authentication;
    }
         
    public function addUser(Array $data)
    {
        $user = new User();
        $user->exchangeArray($data);
        if ($data['password'] != '') {
            // encrypt password
            $bcrypt = $this->getAuthentication()->getAdapter()->getBcrypt();
            
            $hash = $bcrypt->create($user->getPass());
                       
            $user->setPass($hash);
        }
        $data = $user->getArrayCopy();
        $data['role'] = 'admin';
        return $this->_userTable->saveUser($data);
    }
    
    public function editUser(Array $data)
    {
        $this->_userTable->updateUser($data);
    }
    
    public function deleteUser($id)
    {
        $this->_userTable->delete($id);
    }
    
    
    public function login(Array $data)
    {
        $form = $this->getForm();
        $form->setData($data);
        if(!$form->isValid()) {
            foreach($form->getMessages() AS $key => $message){
                foreach ($message as $value) {
                     $messageString .= $value;
                }
            }
            $this->setMessage($messageString);
            return false;
        }
        
        $user = $form->getData();
        $authentication = $this->getAuthentication();
        $authentication->getAdapter()->setIdentity($user['email']);
        $authentication->getAdapter()->setCredential($user['password']);
        
        $result = $authentication->authenticate();
        
        $messages = $result->getMessages();
        
        $this->setMessage($messages[0]);
        
        if(!$result->isValid()) {
            return false;
        }
        
        return $result->getIdentity();
        
    }
    
    public function logout()
    {
        $authentication = $this->getAuthentication();
        
        $authentication->clearIdentity();
        
        $authNamespace = new Container(Session::NAMESPACE_DEFAULT);
        $authNamespace->getManager()->destroy();
        $this->setMessage('Sie wurden abgemeldet');
        return true;
        
    }
    
}
