<?php
namespace User\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserIsAllowedFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $acl = $sm->get('User\Acl\AclService');
        $helper = new UserIsAllowed($acl);
        return $helper;
    }
}
