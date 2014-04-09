<?php
namespace User\Forms;

use Zend\Form\Form;
use User\Filter\LoginFilter;

class LoginForm extends Form
{
    public function __construct($name = 'login') 
    {
        parent::__construct('login');
        $inputFilter = new LoginFilter();
        $this->setAttribute('method', 'post');
        $this->setInputFilter($inputFilter);
        $this->setValidationGroup(array('email', 'password'));
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
                'class' => 'auth_btn'
                ),
        ));
        
        
    }
}