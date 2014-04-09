<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Forms\LoginForm;
use Zend\Http\PhpEnvironment\Response;
use User\Service\UserService;

class UserController extends AbstractActionController
{
    protected $_userService;
    protected $_loginForm;

    public function indexAction()
    {
        //check identity
        if(!$this->getUserService()->getAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('user', array('action' => 'login'));
        }
        //hier muss dann zum ticketsystem umgeleitet werden
      
    }
    
    public function loginAction()
    {
        
        $prg = $this->prg($this->url()->fromRoute('user', array('action' => 'login')), true);
       
        if($prg instanceof Response) {
            return $prg;
        } elseif($prg !== false) {
            $user = $this->getUserService()->login($prg);
            if($user) {
               $this->flashMessenger()->addMessage($this->getUserService()->getMessage() );
               return $this->redirect()->toRoute('application');
            } else {
                $this->flashMessenger()->addMessage($this->getUserService()->getMessage() );
               return $this->redirect()->toRoute('user', array('action' => 'login'));
            }
        }
                
        return new ViewModel(array(
            'form' => $this->getLoginForm(),
        ));
    }
    
    public function logoutAction()
    {
        if($this->getUserService()->getAuthentication()->hasIdentity()) {
            $this->getUserService()->logout();
            
            $this->flashMessenger()->addMessage(
                $this->getUserService()->getMessage()
            );
        }
        
       return $this->redirect()->toRoute('user');
    }
    
    
    
    public function forbiddenAction()
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_403);
    }
    
    public function setUserService(UserService $userService)
    {
        $this->_userService = $userService;
        return $this;
    }
    
    public function getUserService()
    {
        return $this->_userService;
    }
    
    public function setLoginForm(LoginForm $form)
    {
        $this->_loginForm = $form;
        return $this;
    }
    
    public function getLoginForm()
    {
        return $this->_loginForm;
    }
}