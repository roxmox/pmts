<?php
namespace Tickets\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class CommentsHelperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm = $serviceLocator->getServiceLocator();
        $helper = new CommentsHelper();
        $commentService = $sm->get('Tickets\Service\Comments');
        $helper->setCommentService($commentService);
        return $helper;
    }
}
