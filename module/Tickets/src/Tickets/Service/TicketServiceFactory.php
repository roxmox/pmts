<?php
namespace Tickets\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Service\TicketService;

class TicketServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
         $service = new TicketService();
         return $service;
    }
}