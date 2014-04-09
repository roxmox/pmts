<?php
namespace Tickets\Model\Tables\Factories;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Model\Tables\PrioTable;

class PrioTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $prio = $serviceLocator->get('Tickets\Model\Entities\Prio');
        
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($prio);
        
        $tableGateway = new TableGateway('tks_prio', $adapter, null, $resultSetPrototype);
        $prioTable = new PrioTable($tableGateway);
        
        return $prioTable;
    }
}

