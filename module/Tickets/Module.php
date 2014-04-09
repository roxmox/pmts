<?php
namespace Tickets;

use Zend\Filter\StaticFilter;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\MvcEvent;


class Module implements 
    ConfigProviderInterface, 
    AutoloaderProviderInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $_serviceLocator = null;
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function onBootstrap(MvcEvent $event)
    {
        $this->_serviceLocator = $event->getApplication()->getServiceManager();
        $eventManager       = $event->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        
        // add form event
        $sharedEventManager->attach(
            'Tickets\Service\TicketService',
            'set-form',
            array($this, 'onFormSet')
        );

        // add table event - ticketService
        $sharedEventManager->attach(
            'Tickets\Service\TicketService',
            'set-table',
            array($this, 'onTableSet')
        );
                
    }
    
    public function onTableSet(EventInterface $e)
    {
        $serviceLocator =  $this->_serviceLocator;
        $type = $e->getParam('type','ticket_table');
        $tableName = StaticFilter::execute($type, 'wordunderscoretocamelcase');
        $service   = $serviceLocator->get('Tickets\Service\Ticket');
        $table = $serviceLocator->get('Tickets\Model\Tables\\' . $tableName);
        $service->setTable($table, $type);
    }
    
    public function onFormSet(EventInterface $e)
    {
        $serviceLocator =  $this->_serviceLocator;
        $type = $e->getParam('type','ticket_form');
        $formName = StaticFilter::execute($type, 'wordunderscoretocamelcase');
        $service   = $serviceLocator->get('Tickets\Service\Ticket');
        $form = $serviceLocator->get('Tickets\Forms\\' . $formName);
        $service->setForm($form, $type);
        
    }
}
