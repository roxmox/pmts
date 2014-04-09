<?php
namespace User\Acl;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
       $auth   = $serviceLocator->get('User\Auth\AuthService');
      
       $role   = $auth->hasIdentity() ? $auth->getIdentity()->getRole() : 'guest';
       $acl = new Service($role);
       return $acl;
    }
}