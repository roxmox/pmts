<?php
namespace Tickets\Model\Tables\Factories;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Model\Tables\StatusTable;

class StatusTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $status = $serviceLocator->get('Tickets\Model\Entities\Status');
        
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($status);
        
        $tableGateway = new TableGateway('tks_status', $adapter , null, $resultSetPrototype);
        $statusTable = new StatusTable($tableGateway);
       
        return $statusTable;
    }
}

