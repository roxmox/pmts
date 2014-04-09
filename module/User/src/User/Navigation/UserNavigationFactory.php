<?php
namespace User\Navigation;

use Zend\Navigation\Service\AbstractNavigationFactory;

class UserNavigationFactory extends AbstractNavigationFactory
{
    public function getName() 
    {
        return 'user_menu';
    }
}

