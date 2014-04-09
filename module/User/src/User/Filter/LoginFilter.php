<?php
namespace User\Filter;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter
{
    /**
     * Build filter
     */
    public function __construct()
    {
        $this->add(array(
            'name'       => 'email',
            'required'   => false,
            'filters'    => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'EmailAddress',
                    'options' => array(
                        'useDomainCheck' => false,
                        'message'        => 'Keine gültige E-Mail-Adresse',
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'password',
            'required'   => false,
            'filters'    => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8', 
                        'min'      => 5, 
                        'max'      => 128,
                        'message'  => 'Passwort muss mindestens 5 Zeichen lang sein',
                    ),
                ),
            ),
        ));
    }
}
