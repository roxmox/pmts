<?php
namespace User\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserShowWidgetFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $identity = $sm->get('User\Auth\AuthService')->getIdentity();
        $service = $sm->get('User\Service\User');
        $helper = new UserShowWidget($identity, $service);
        return $helper;
    }
}

