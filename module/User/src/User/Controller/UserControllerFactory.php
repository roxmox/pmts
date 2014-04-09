<?php
namespace User\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Forms\LoginForm;

class UserControllerFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service    = $serviceLocator->getServiceLocator()->get('User\Service\User');
        $form = new LoginForm('login');
        $controller = new UserController();
        $controller->setUserService($service);
        $controller->setLoginForm($form);
        return $controller;
    }
}
