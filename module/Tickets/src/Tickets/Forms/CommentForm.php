<?php
namespace Tickets\Forms;

use Zend\Form\Form;

class CommentForm extends Form
{
    protected $_userId = null;
        
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
    
        
    /*
     * form construct
     */
    
    public function __construct()
    {
        parent::__construct('comment');
        $this->setAttribute('method', 'post');
    }
    
    public function getForm()
    {
        
        /*
         * comment element
         */
        $this->add(array(
            'name' => 'comment',
            'attributes' => array(
                'type' => 'textarea',
                'cols' => '65',
                'rows' => '10',
                'id'   => 'comment',
            ),
            'options' => array(
                'label' => 'Comment'
            ),
        ));
        
               
        /*
         * hidden elements
         */
        $this->add(array(
            'name' => 'ticket_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
                
        $this->add(array(
            'name' => 'user_id',
            'attributes' => array(
                'type'  => 'hidden',
                'value' => $this->getUserId(),
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

