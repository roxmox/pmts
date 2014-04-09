<?php
namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use User\Acl\AclService;

class UserIsAllowed extends AbstractHelper
{
    protected $_acl;
    
    public function __construct(AclService $acl) 
    {
        $this->setAcl($acl);
    }
    
    public function setAcl(AclService $acl = null)
    {
        $this->_acl = $acl;
        return $this;
    }
    
    public function getAcl()
    {
        return $this->_acl;
    }
    
    public function __invoke($resource, $privilege = 'index')
    {
        return $this->getAcl()->isAllowed($resource, $privilege);
    }
}
