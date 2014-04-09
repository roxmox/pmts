<?php
namespace Tickets\Model\Tables\Factories;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Model\Tables\DepartmentTable;

class DepartmentTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $department = $serviceLocator->get('Tickets\Model\Entities\Department');
        
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($department);
        
        $tableGateway = new TableGateway('tks_departments', $adapter, null, $resultSetPrototype);
        $departmentTable = new DepartmentTable($tableGateway);
        
        return $departmentTable;
    }
}

