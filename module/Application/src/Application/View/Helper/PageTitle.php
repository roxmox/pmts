<?php
namespace Application\View\Helper;

use Zend\View\Helper\HeadTitle;

class PageTitle extends HeadTitle
{
    protected $regKey = 'Application_View_Helper_PageTitle';

    protected $autoEscape = false;

    protected $separator = ' &raquo; ';

    public function toString($indent = null)
    {
        $output = parent::toString($indent);
        $output = str_replace(
            array('<title>', '</title>'), array('<h4>', '</h4>'), $output
        );
        
        return $output;
    }
}

