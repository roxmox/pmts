<?php
namespace Tickets\Forms;

use Zend\Form\Form;
use Tickets\Filter\TicketFilter;

class TicketForm extends Form
{
    protected $_userId = null;
    protected $_prioArray = null;
    protected $_statusArray = null;
    protected $_userArray = null;
    protected$_departmentsArray = null;
    protected $_projectsArray = null;
    

    /*
     * getter and setter
     */
    public function setUserId($id)
    {
        $this->_userId = $id;
        return $this;
    }
    
    public function getUserId() 
    {
        return $this->_userId;
    }
    
    public function setPrioArray($array)
    {
        $this->_prioArray = $array;
    }
    
    public function getPrioArray()
    {
        return $this->_prioArray;
    }
    
    public function setStatusArray($array)
    {
        $this->_statusArray = $array;
    }
    
    public function getStatusArray()
    {
        return $this->_statusArray;
    }
    
        
    public function setUserArray($array)
    {
        $this->_userArray = $array;
    }
    
    public function getUserArray()
    {
        return $this->_userArray;
    }
    
    
    public function setDepartmentsArray($array)
    {
        $this->_departmentsArray = $array;
    }
    
    public function getDepartmentsArray()
    {
        return $this->_departmentsArray;
    }
    
    public function setProjectsArray($array)
    {
        $this->_projectsArray = $array;
    }
    
    public function getProjectsArray()
    {
        return $this->_projectsArray;
    }
        
    /*
    * form construct
    */
    public function __construct()
    {
        parent::__construct('ticket');
        $inputFilter = new TicketFilter();
        $this->setInputFilter($inputFilter);
        $this->setAttribute('method', 'post');
    }
    
    public function getForm()
    {
        /*
         * title element
         */
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                'size' => '106px'
            ),
            'options' => array(
                'label' => 'Titel'
            ),
        ));
        
        /*
         * ticket element
         */
        $this->add(array(
            'name' => 'ticket',
            'attributes' => array(
                'type' => 'textarea',
                'cols' => '85',
                'rows' => '20',
            ),
            'options' => array(
                'label' => 'Ticket'
            ),
        ));
        
        /*
         * priority element
         */
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'prio_id',
            'options' => array(
                'label' => 'Priorität',
                'empty_option' => 'auswählen',
                'value_options' => $this->getPrioArray(),
            ),
            'attributes' => array(
                'value' => ''
            ),
        ));
        
        /*
         * status element
         */
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status_id',
            'options' => array(
                'label' => 'Status',
                'value_options' => $this->getStatusArray(),
            ),
            'attributes' => array(
                'value' => '1'
            ),
        ));
        
        /*
         * assign element  #wird durch departments ersetzt
         */
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'assign_id',
            'options' => array(
                'label' => 'Zugewiesen',
                'empty_option' => '-Mitarbeiter-',
                'value_options' => $this->getUserArray(),
            ),
            'attributes' => array(
                'value' => '0',
            ),
        ));
        
        
        /*
         * departments element
         */
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'department_id',
            'options' => array(
                'label' => 'Abteilung',
                'empty_option' => 'auswählen',
                'value_options' => $this->getDepartmentsArray(),
            ),
            'attributes' => array(
                'value' => ''
            ),
        ));
        
         /*
         * project element
         */
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'project_id',
            'options' => array(
                'label' => 'Projekt',
                'empty_option' => 'auswählen',
                'value_options' => $this->getProjectsArray(),
            ),
            'attributes' => array(
                'value' => ''
            ),
        ));
        
        /*
         * deadline element
         */
        $this->add(array(
            'name' => 'deadline',
            'attributes' => array(
                'type' => 'text',
                'size' => '16px',
                'class' => 'date-pick dp-applied',
                'value' => 'Klick'
            ),
            'options' => array(
                'label' => 'Termin'
            ),
        ));
        
        /*
         * hidden elements
         */
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
                
        $this->add(array(
            'name' => 'creator_id',
            'attributes' => array(
                'type'  => 'hidden',
                'value' => $this->getUserId(),
            ),
        ));
        
        $this->add(array(
            'name' => 'assumed',
            'attributes' => array(
                'type'  => 'hidden',
                'value' => '',
            ),
        ));
        
        $this->add(array(
            'name' => 'status_id',
            'attributes' => array(
                'type'  => 'hidden',
                'value' => '',
            ),
        ));
        
//        $this->add(array(
//            'name' => 'hidden_department_id',
//            'attributes' => array(
//                'type'  => 'hidden',
//                'value' => '',
//            ),
//        ));
          
        $this->add(array(
            'name' => 'tmp_file',
            'attributes' => array(
                'type'  => 'hidden',
                'id' => 'tmp_file',
            ),
        ));  
                       
        /*
         * submit element
         */
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'submitbutton'
                ),
        ));
        return $this;
    }
    
}

