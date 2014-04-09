<?php
namespace Tickets\Model\Tables\Factories;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Model\Tables\TicketTable;

class TicketTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $ticket = $serviceLocator->get('Tickets\Model\Entities\Ticket');
        
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($ticket);
        
        $tableGateway = new TableGateway('tks_tickets', $adapter);
        $ticketTable = new TicketTable($tableGateway);
      
        return $ticketTable;
    }
}

