<?php
namespace Tickets\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Tickets\Service\CommentService;

class CommentServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
         $commentTable = $serviceLocator->get('Tickets\Model\Tables\CommentTable'); 
         $form = $serviceLocator->get('Tickets\Forms\CommentForm');
         $acl = $serviceLocator->get('User\Acl\AclService');
         $service = new CommentService();
         $service->setCommentForm($form);
         $service->setAcl($acl);
         $service->setCommentTable($commentTable);
         return $service;
    }
}