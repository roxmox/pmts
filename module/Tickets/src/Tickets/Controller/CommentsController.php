<?php
namespace Tickets\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Tickets\Service\CommentService;

class CommentsController extends AbstractActionController
{
    protected $_identity = null;
    protected $_commentsService = null;

    /*
     * getter and setter
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
    }
    
    public function getIdentity()
    {
        return $this->_identity;
    }
    
    public function setService(CommentService $service)
    {
        $this->_commentService = $service;
    }
    
    public function getService()
    {
        return $this->_commentService;
    }    
     
    
    public function indexAction() 
    {
         $id = (int) $this->params()->fromRoute('id', 0);
         echo $this->getService()->getCommentsByTicketId($id);
         exit;
                
    }
    
    public function newAction()
    {
        $prg = $this->prg('/index.php/comments/new', true);
              
        if($prg instanceof Response) {
            return $prg;
        } elseif($prg !== false) {
            $this->getService()->saveComment($prg);
        }
        exit;
    }
    
    public function editAction()
    {
        $prg = $this->prg('/index.php/comments/edit', true);
              
        if($prg instanceof Response) {
            return $prg;
        } elseif($prg !== false) {
            $this->getService()->updateCommentById($prg);
        }
        exit;
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $this->getService()->deleteCommentById($id);
        exit;
    }
    
    
}


