<?php
namespace Tickets\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;



class TicketsControllerFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $identity = $sm->get('User\Auth\AuthService')->getIdentity();
        $service = $sm->get('Tickets\Service\Ticket');
        $controller = new TicketsController();
        $controller->setIdentity($identity);
        $controller->setService($service);
        return $controller;
    }
}