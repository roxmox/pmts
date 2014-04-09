<?php
namespace Tickets\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;


class NaviWidget extends AbstractHelper
{
    protected $_identity;
    
    
    
    public function __invoke($controller = '')
    {
        return $this->buildWidget($controller);
    }
    
    public function buildWidget($controller)
    {
        $vm = new ViewModel(array(
            'identity' => $this->getIdentity(),
            'controller' => $controller,
            ));
        $vm->setTemplate('widget/navi');
        return $this->getView()->render($vm);
    }
    
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
    }
    
    public function getIdentity()
    {
        return $this->_identity;
    }
}



