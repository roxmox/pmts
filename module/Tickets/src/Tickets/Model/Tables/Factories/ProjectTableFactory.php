<?php
namespace Tickets\Model\Tables\Factories;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Model\Tables\ProjectTable;

class ProjectTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $project = $serviceLocator->get('Tickets\Model\Entities\Project');
        
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($project);
        
        $tableGateway = new TableGateway('tks_projects', $adapter, null, $resultSetPrototype);
        $projectTable = new ProjectTable($tableGateway);
        
        return $projectTable;
    }
}

