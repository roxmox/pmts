<?php
namespace User\Acl;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AclServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
       $auth   = $serviceLocator->get('User\Auth\AuthService');
      
       $role   = $auth->hasIdentity() ? $auth->getIdentity()->getRole() : 'guest';
       $acl = new AclService($role);
       return $acl;
    }
}