<?php
namespace User\Acl;

use Zend\Permissions\Acl\Acl;

class Service
{
    protected $_role = 'guest';
    protected $_config = array();
    protected $_acl = null;
    
    public function __construct($role = 'guest') 
    {
        $this->setRole($role);
        $this->setAcl($this->buildAcl());
        //echo var_dump($this->isAllowed('application', 'index' ));
    }
    
    public function buildAcl()
    {
        $acl = new Acl();
        $acl->addRole('guest');
        $acl->addRole('office', 'guest');
        $acl->addRole('dev', 'office');
        $acl->addRole('admin');
        
        $acl->addResource('user');
        $acl->addResource('user-admin');
        $acl->addResource('tickets');
        $acl->addResource('Application\Controller\Index');
        
        
        // guest allow login
        $acl->allow('guest', 'user', array('index','login'));
        //office allow login/logout/select
        $acl->allow('office', 'user', array('index','login','logout'));
        $acl->allow('office', 'Application\Controller\Index', array('index', 'select'));
        $acl->allow('office', 'tickets', array('index','mytickets','new','show','setstatus','edit'));
        //allow developer login/logout/select/indexAction userAdmin
        $acl->allow('dev', 'user-admin', array('index'));
        //allow admin all
        $acl->allow('admin');
                
        //ticket rules
        return $acl;
    }
    
    public function isAllowed($resource, $privilege)
    {
        if(empty($resource) || !$this->getAcl()->hasResource($resource) ) {
            return false;
        }
        
        if(empty($privilege)) {
            return false;
        }
        return $this->getAcl()->isAllowed($this->getRole(), $resource, $privilege);
    }
   
    
    /*
     * getter and setter
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }
    
    public function getRole()
    {
        return $this->_role;
    }
      
    
    public function setAcl($acl)
    {
        $this->_acl = $acl;
    }
    
    public function getAcl()
    {
        return $this->_acl;
    }
    
    
}
