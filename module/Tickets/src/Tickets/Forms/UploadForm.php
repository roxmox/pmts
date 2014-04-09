<?php
namespace Tickets\Forms;

use Zend\Form\Form;

class UploadForm extends Form
{
    public function __construct() 
    {
        parent::__construct('fileupload');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
        
         $this->add(array(
            'name' => 'fileupload',
            'attributes' => array(
                'type'  => 'file',
                'id' => 'file-upload',
            ),
            'options' => array(
                'label' => 'File Upload',
            ),
        )); 
    }
}


