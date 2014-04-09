<?php
namespace Tickets\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;


class ShowControllerWidget extends AbstractHelper
{
    protected $_ticketService;
    protected $_identity;
    
    public function __construct($identity, $ticketService)
    {
        $this->setIdentity($identity);
        $this->setTicketService($ticketService);
    }
    
    
    /*
     * getter and setter
     */
    public function setIdentity($identity = null)
    {
        $this->_identity = $identity;
    }
    
    public function getIdentity()
    {
        return $this->_identity;
    }
    
    public function setTicketService($service)
    {
        $this->_ticketService = $service;
    }
    
    public function getTicketService()
    {
        return $this->_ticketService;
    }
    
    public function __invoke()
    {
        return $this->buildWidget();
    }
    
    public function buildWidget()
    {
        $userId = $this->getIdentity()->id;
        $vm = new ViewModel(array(
            'identity' => $this->getIdentity(),
            //'stats' => $this->getTicketService()->getUserStats()
        ));
        $vm->setTemplate('widget/controller');
        
        return $this->getView()->render($vm);
    }
   
   
}


