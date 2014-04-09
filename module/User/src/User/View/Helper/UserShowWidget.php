<?php

namespace User\View\Helper;

use User\Model\Entities\User;
use User\Service\UserService;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use User\Forms\LoginForm;

class UserShowWidget extends AbstractHelper
{
    protected $_identity;
    protected $_userServervice;
    
    public function __construct(User $identity = null, UserService $userService)
    {
        $this->setIdentity($identity);
        $this->setUserService($userService);
    }
    
    public function setIdentity(User $identity = null)
    {
        $this->_identity = $identity;
    }
    
    public function getIdentity()
    {
        return $this->_identity;
    }
    
    public function setUserService(UserService $userService = null)
    {
        $this->_userServervice = $userService;
    }
    
    public function getUserService()
    {
        return $this->_userService;
    }
    
    public function __invoke()
    {
        if($this->getIdentity()) {
            return $this->buildLogoutWidget() ;
        } else {
            return $this->buildLoginWidget() ;
        }
    }
    
    public function buildLoginWidget()
    {
        $form = new LoginForm();
        $vm = new ViewModel(array('form' => $form));
        
        $vm->setTemplate('widget/login');
             
       return $this->getView()->render($vm);
    }
    
    public function buildLogoutWidget()
    {
        $vm = new ViewModel(array(
            'identity' => $this->getIdentity(),
        ));
        $vm->setTemplate('widget/logout');
        
        return $this->getView()->render($vm);
    }

}
