<?php
namespace Tickets\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;


class CommentsHelper extends AbstractHelper
{
    protected $_identity;
    protected $_commentService;


    public function __invoke($ticketId)
    {
        return $this->buildWidget($ticketId);
    }
    
    public function buildWidget($ticketId)
    {
        $form = $this->getCommentService()->getCommentForm(); 
        $form->get('submit')->setValue('Kommentar hinzufügen');
        $form->get('ticket_id')->setValue($ticketId);
        
        $vm = new ViewModel(array(
            'form' => $form,
            'ticketId' => $ticketId,
            ));
        $vm->setTemplate('comments/helper');
        
        return $this->getView()->render($vm);
    }
    
    public function setCommentService($service)
    {
        $this->_commentService = $service;
    }
    
    public function getCommentService()
    {
        return $this->_commentService;
    }
      
}
