<?php
namespace User\Authentication;

use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbBcryptAdapterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
        $table = $serviceLocator->get('User\Model\Dbtables\User');
        $bcrypt = new Bcrypt();
        //$bcrypt = new Bcrypt(array('cost' => 12));
        //DbBcrypt adapter erstellen und ausliefern
        $adapter = new DbBcryptAdapter($table, $bcrypt);
        return $adapter;
    }
}