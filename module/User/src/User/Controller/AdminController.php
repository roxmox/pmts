<?php
namespace User\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Forms\UserForm;
use User\Service\UserService;



class AdminController extends AbstractActionController
{
    protected $_userService = null;
    
       
    public function setUserService(UserService $userService)
    {
        $this->_userService = $userService;
        //echo var_dump($this->_userService);exit;
        return $this;
    }
    
    public function getUserService()
    {
        return $this->_userService;
    }
    
    public function indexAction()
    {
        //check identity
        if(!$this->getUserService()->getAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('user', array('action' => 'login'));
        }
        
        return $this->redirect()->toRoute('user-admin', array('action' => 'show'));
    }
    
    public function showAction()
    {
        return array(
            'test' => 'Anzeige aller nutzer',
        );
    }
    
    
    public function addAction()
    {
        $form = new UserForm(); 
        $form->get('submit')->setValue('add');
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                
                echo $this->getUserService()->addUser($form->getData());
                
                return $this->redirect()->toRoute('user-admin');
            }
       }
       return array('form' => $form);
    
    }
    
    public function editAction()
    {
         echo 'edit Action'; 
    }
    
    public function deleteAction()
    {
         echo 'delete Action'; 
    }
    
    public function forbiddenAction()
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_403);
    }
}
