<?php
namespace Tickets\Model\Tables\Factories;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Model\Tables\CommentTable;

class CommentTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $comment = $serviceLocator->get('Tickets\Model\Entities\Comment');
        
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($comment);
        
        $tableGateway = new TableGateway('tks_comments', $adapter);
        $commentTable = new CommentTable($tableGateway);
        
        return $commentTable;
    }
}

