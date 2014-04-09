<?php
namespace Tickets\Navigation;

use Zend\Navigation\Service\AbstractNavigationFactory;

class TicketNavigationFactory extends AbstractNavigationFactory
{
    public function getName() 
    {
        return 'tickets_menu';
    }
}

