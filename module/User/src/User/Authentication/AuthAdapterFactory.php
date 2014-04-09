<?php
namespace User\Authentication;

use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthAdapterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) 
    {
        $table = $serviceLocator->get('User\Model\Dbtables\User');
        $bcrypt = new Bcrypt();
        //DbBcrypt adapter erstellen und ausliefern
        $adapter = new AuthAdapter($table, $bcrypt);
        return $adapter;
    }
}