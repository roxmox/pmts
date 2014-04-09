<?php
namespace Tickets\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class NaviWidgetFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $identity = $sm->get('User\Auth\AuthService')->getIdentity();
        $helper = new NaviWidget();
        $helper->setIdentity($identity);
        return $helper;
    }
}