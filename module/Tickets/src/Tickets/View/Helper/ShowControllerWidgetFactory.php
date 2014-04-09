<?php
namespace Tickets\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ShowControllerWidgetFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $identity = $sm->get('User\Auth\AuthService')->getIdentity();
        $service = $sm->get('Tickets\Service\Ticket');
        $helper = new ShowControllerWidget($identity, $service);
        return $helper;
    }
}