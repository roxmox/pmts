<?php
namespace User\Model\Dbtables;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Model\Dbtables\UserTable;

class UserTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //db adapter initialisieren
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new ResultSet();
        $user = $serviceLocator->get('User\Model\Entities\User');
        $resultSetPrototype->setArrayObjectPrototype($user);
        $tableGateway = new TableGateway('users', $adapter, null, $resultSetPrototype);
        $userTable = new UserTable($tableGateway);
        return $userTable;
    }
}