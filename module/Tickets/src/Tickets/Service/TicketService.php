<?php
namespace Tickets\Service;

use Tickets\Model\Entities\Ticket;
use Tickets\Service\FileService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;


class TicketService implements EventManagerAwareInterface 
{
    protected $_tables = array();
    protected $_forms = array(); 
    protected $_eventManager = null;
    protected $_fileService = null;
    protected $_message;
    
    public function getFileService()
    {
        if(!is_object($this->_fileService)){
            $this->_fileService = new FileService();
        }
        return $this->_fileService;
    }
    
    public function setMessage($message)
    {
        $this->_message = $message;
    }
    
    public function getMessage()
    {
        return $this->_message;
    }
    
    public function clearMessage()
    {
        $this->_message = '';
    }   
    
    public function setEventManager(EventManagerInterface $eventManager)
    {
        if(null === $this->_eventManager){
            $this->_eventManager = $eventManager;
        }        
    }
    
    public function getEventManager()
    {
        if(null === $this->_eventManager){
            $this->setEventManager(new EventManager());
        }
        
        return $this->_eventManager; 
    }
    
    public function setTable($table, $type = 'ticket_table')
    {
        if(!isset($this->_tables[$type])){
            $this->_tables[$type] = $table;
        }
        
    }
    
    public function getTable($type = 'ticket_table')
    {
        $this->getEventManager()->addIdentifiers(array(__CLASS__));
        $this->getEventManager()->trigger('set-table', __CLASS__,array('type' => $type ));
        
        return $this->_tables[$type];
    }
    
    public function setForm($form, $type = 'ticket_form')
    {
        if(!isset($this->_forms[$type])){
            $this->_forms[$type] = $form;
        }
        
    }
    
    public function getForm($type = 'ticket_form')
    {
        $this->getEventManager()->addIdentifiers(array(__CLASS__));
        $this->getEventManager()->trigger('set-form', __CLASS__,array('type' => $type ));
        
        return $this->_forms[$type];
    }
    
    public function getEditForm($id)
    {
        $ticket = $this->getTable('ticket_table')->getTicketsById(array('id' => (int)$id));
        $form = $this->getForm('ticket_form');
        $form->setData($ticket[0]);
        
        return $form;
    }
            
    
    public function execute(Array $data, $mode = 'insert')
    {
        if($mode != 'delete'){
            $form = $this->getForm('ticket_form');
            $ticket = new Ticket();
            $ticket->exchangeArray($data);
            $data = $ticket->getArrayCopy();
            $form->setData($data);
                
            if(!$form->isValid()){
                return;
            }
        }
        
        
        switch($mode){
            case 'update':
                if($this->getTable('ticket_table')->update($data)){
                    $this->setMessage('Ticket #'.$data['id'].' wurde geändert');
                    return $data['id'];
                }
                $this->setMessage('Ticket #'.$data['id'].' konnte nicht geändert werden');
                $response = false;
                break;
            
            case 'delete':
                if($this->getTable('ticket_table')->delete($data['id'])){
                    $this->setMessage('Ticket #'.$data['id'].' wurde gelöscht');
                    return true;
                }
                $this->setMessage('Ticket #'.$data['id'].' konnte nicht gelöscht werden');
                $response = false;
                break;
            
            default:
                $data['status_id'] = 1;
                $data['assign_id'] = 0;
                $data['assumed'] = 0;
                
                $insertId = $this->getTable('ticket_table')->insert($data);
                            
                if($insertId !== false){
                    $this->copyFile($data['tmp_file'], $data['fileupload'], $insertId);
                    $this->setMessage('Ticket #'.$insertId.' wurde gespeichert');
                    return true;
                }
                $this->setMessage('Ticket konnte nicht gespeichert werden');
                $response = false;
                break;
        }
        return $response;
    }
        
        
    public function saveTmpFile($data)
    {
        $this->getFileService()->setFile($data);
        return $this->getFileService()->saveFile('tmp');
    }
    
    public function removeTmpFile($filename = null)
    {
        $this->getFileService()->removFile($filename);
    }
    
    public function getFormArray($table = 'status_table')
    {
        return $this->getTable($table)->getFormArray();
    }
    
    public function getAllTicketsById(Array $whereArray)
    {
        $data = array();
        
        $tickets = $this->getTable('ticket_table')->getTicketsById($whereArray);
        
        foreach($tickets AS $ticketArr){
            $ticket = new Ticket();
            $ticket->exchangeArray($ticketArr);
            $ticket->setAssumed($ticketArr['assumed']);
            $reference = $ticket->getReferenceMap();
            
            foreach($reference AS $table => $cols){
                //get reference Table
                $refTable = $this->getTable($table . '_table');
                
                //get Method to get reference Id for table
                $getMethod = 'get' . ucfirst($table) . 'Id';
                
                if(!method_exists($ticket, $getMethod)){
                    continue;
                }
                
                $id = $ticket->$getMethod();
                
                //get Values from from reference Table by Id
                $refTableResultObj = $refTable->getById($id);
                
                foreach($cols AS $col){
                    if($col == $table){
                        $setMethod = 'set' . ucfirst($col);
                    }else{
                        $setMethod = 'set' . ucfirst($table).ucfirst($col);
                    }
                    
                    if(!method_exists($ticket, $setMethod)){
                        continue;
                    }
                    
                    //set values to ticket entity
                    $ticket->$setMethod($refTableResultObj->$col);
                }
            }
        $data[] = $this->_setAssignAndCreator($ticket);    
        }
        return $data;
    }
        
    
    protected function _setAssignAndCreator($ticket)
    {
        $userTable = $this->getTable('user_table');
        
        $creatorId = $ticket->getCreatorId();
        $assignId = $ticket->getAssignId();
        
        if($assignId !=0){
            $assign = $userTable->getById($assignId);
            $ticket->setAssignFirstname($assign->firstname);
            $ticket->setAssignLastname($assign->lastname);
        }
        
        $creator = $userTable->getById($creatorId);
        $ticket->setCreatorFirstname($creator->firstname);
        $ticket->setCreatorLastname($creator->lastname);
           
        
        return $ticket;
    }
        
}

