<?php
namespace Tickets\Filter;

use Zend\InputFilter\InputFilter;

class TicketFilter extends InputFilter
{
    /**
     * Build filter
     */
    public function __construct()
    {
       $this->add(array(
            'name'       => 'title',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8', 
                     ),
                ),
                array(   
                    'name' => 'not_empty',
                    'options' => array(
                        'message' => 'title is empty',
                    )
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'ticket',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8', 
                     ),
                ),
                array(   
                    'name' => 'not_empty',
                    'options' => array(
                        'message' => 'ticket is empty',
                    )
                ),
            ),
        ));
      
        $this->add(array(
            'name'       => 'prio_id',
            'required'   => true,
            'validators' => array(
                array(   
                    'name' => 'not_empty',
                    'options' => array(
                        'message' => 'select priority',
                    )
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'status_id',
            'required'   => false,
        ));
        
        $this->add(array(
            'name'       => 'assign_id',
            'required'   => false,
             'validators' => array(
                array(   
                    'name' => 'not_empty',
                    'options' => array(
                        'message' => 'select assign',
                    )
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'project_id',
            'required'   => true,
             'validators' => array(
                array(   
                    'name' => 'not_empty',
                    'options' => array(
                        'message' => 'select project',
                        'encoding' => 'UTF-8',
                    )
                ),
            ),
        ));
    }
}
