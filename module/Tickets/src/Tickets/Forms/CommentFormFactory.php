<?php
namespace Tickets\Forms;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommentFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
          
          $identity = $serviceLocator->get('User\Auth\AuthService')->getIdentity();
          $form = new CommentForm();
          $form->setUserId($identity->id);
          return $form->getForm();
    }
}

