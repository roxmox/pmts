<?php
namespace User\Authentication;

use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
       $BcryptAdapter = $serviceLocator->get('User\Auth\AuthAdapter');
       
       $auth = new AuthenticationService();
       $auth->setAdapter($BcryptAdapter);
       return $auth;
    }
}