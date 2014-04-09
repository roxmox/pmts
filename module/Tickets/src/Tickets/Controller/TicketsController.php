<?php
namespace Tickets\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Tickets\Service\TicketService;
use Tickets\Service\AjaxService;

class TicketsController extends AbstractActionController
{
    protected $_identity = null;
    protected $_ticketService = null;
    
    /*
     * getter and setter
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
    }
    
    public function getIdentity()
    {
        return $this->_identity;
    }
    
    public function setService(TicketService $service)
    {
        $this->_ticketService = $service;
    }
    
    public function getService()
    {
        return $this->_ticketService;
    } 
    
        
    public function indexAction () 
    {
        $newTickets = $this->getService()
                        ->getAllTicketsById(array(
                            'assumed' => 0, 
                            'assign_id' => 0));
        return array(
            'newTickets' => $newTickets,
            'users' => $this->getService()->getFormArray('user_table'),
        );
    }
    
        
    public function showAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $ticket = $this->getService()->getAllTicketsById(array('id' => $id));
              
        return array(
            'ticket' => $ticket[0],
        );
    }
    
    public function myticketsAction()
    {
        $userId = $this->getIdentity()->id;
        $createdTickets = $this->getService()
                            ->getAllTicketsById(array('creator_id' => $userId));
        
        $assumedTickets = $this->getService()
                            ->getAllTicketsById(array('assign_id' => $userId, 
                                                        'assumed' => 1));
        $notAssumedTickets = $this->getService()
                            ->getAllTicketsById(array('assign_id' => $userId, 
                                                        'assumed' => 0));
        
        $denyTickets = $this->getService()
                            ->getAllTicketsById(array('assign_id' => $userId, 
                                                        'assumed' => 2));
        
        $statusArray = $this->getService()->getFormArray('status_table');
        
        return array(
            'createdTickets' => $createdTickets,
            'assumedTickets'  => $assumedTickets,
            'notAssumedTickets' => $notAssumedTickets,
            'denyTickets' => $denyTickets,
            'select' => $statusArray,
        );
    }
    
    public function newAction()
    {
        $form = $this->getService()->getForm('ticket_form');    
        $form->get('submit')->setValue('Ticket erstellen');
        
        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg($this->url()->fromRoute('tickets', array('action' => 'new')), true);
       
        if($prg instanceof Response) {
            return $prg;
        } elseif($prg !== false) {
            $ticket = $this->getService()->execute($prg, 'insert');
            
            if($ticket) {
               $this->flashMessenger()->addMessage($this->getService()->getMessage() );
                return $this->redirect()->toRoute('tickets', array('action' => 'mytickets'));
            }
        }
                        
        return new ViewModel(array(
            'form' => $form,
            'uploadForm' => $this->getService()->getForm('upload_form'),
        ));
    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg($this->url()->fromRoute('tickets', array('action' => 'edit', 'id' => $id)), true);
       
        if($prg instanceof Response) {
            return $prg;
        } elseif($prg !== false) {
            $ticketId = $this->getService()->execute($prg, 'update');
            if(false !== $ticketId) {
               $this->flashMessenger()->addMessage($this->getService()->getMessage() );
               return $this->redirect()->toRoute('tickets', array('action' => 'show', 'id' => $ticketId));
            }
        }
        
        
        $editForm = $this->getService()->getEditForm($id);
        $editForm->get('submit')->setValue('speichern'); 
        
        return array(
                 'form' => $editForm,
            );
         
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if($this->getService()->execute(array('id' => $id), 'delete')){
             $this->flashMessenger()->addMessage($this->getService()->getMessage() );
             return $this->redirect()->toRoute('tickets', array('action' => 'mytickets'));
        }
        
        
        $this->flashMessenger()->addMessage($this->getService()->getMessage() );
        return $this->redirect()->toRoute('tickets', array('action' => 'show', 'id' => $id));
    }
    
    
    
    public function statusAction()
    {
        $request = $this->getRequest();
        $data = $request->getPost()->toArray();
        
        if($this->getService()->getTable('ticket_table')->update($data)){
            $status = $this->getService()->getTable('status_table')->getById($data['status_id']);
            echo $status->color;exit;
        }
        exit;
    }
    
    public function changeAction()
    {
        $request = $this->getRequest();
        $data = $request->getPost()->toArray();
        $this->getService()->getTable('ticket_table')->update($data);
        exit;
    }
        
    public function fileuploadAction()
    {
        $request = $this->getRequest();
        $data = $request->getFiles()->toArray();
        echo $this->getService()->saveFile($data);exit;
        
    }
    
    public function removeFileAction()
    {
        $request = $this->getRequest();
        $data = $request->getPost()->toArray();
        echo $this->getService()->removeTmpFile($data['file']);exit;
    }
    
}

