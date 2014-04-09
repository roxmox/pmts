<?php
namespace Tickets\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class CommentsControllerFactory implements FactoryInterface
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
        $service = $sm->get('Tickets\Service\Comments');
        $controller = new CommentsController();
        $controller->setIdentity($identity);
        $controller->setService($service);
        return $controller;
    }
}

