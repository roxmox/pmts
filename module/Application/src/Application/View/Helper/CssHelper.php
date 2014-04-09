<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class CssHelper extends AbstractHelper
{
    protected $_files;
    protected $_view;

    
    
    public function __invoke()
    {
        return array(
            1 => 'test.css',
            2 => 'test2.css',
        );
    }
    
    protected function fetchFiles()
    {
        
    }
}

