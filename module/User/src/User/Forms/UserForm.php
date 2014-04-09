<?php
namespace User\Forms;

use Zend\Form\Form;
use User\Filter\UserFilter;

class UserForm extends Form
{
    protected $_userId;
    protected $_prioArray;
    protected $_statausArray;
    
    /*
     * getter and setter
     */
    
    
    public function __construct($name = null) 
    {
        parent::__construct('add');
                
        $inputFilter = new UserFilter();
        $this->setInputFilter($inputFilter);
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
              'type' => 'text',  
            ),
            'options' => array(
                'label' =>  'Name',
            ),
        ));
        
         $this->add(array(
            'name' => 'lastname',
            'attributes' => array(
              'type' => 'text',  
            ),
            'options' => array(
                'label' =>  'Nachname',
            ),
        ));
         
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
              'type' => 'text',  
            ),
            'options' => array(
                'label' =>  'Email',
            ),
        ));
                
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
              'type' => 'password',  
            ),
            'options' => array(
                'label' =>  'Passwort',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'login',
                'id' => 'submitbutton'
                ),
        ));
        
    }
}
