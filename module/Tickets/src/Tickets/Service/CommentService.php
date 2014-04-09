<?php
namespace Tickets\Service;

use Tickets\Forms\CommentForm;
use Tickets\Model\Tables\CommentTable;


class CommentService
{
    protected $_commentTable;
    protected $_commentForm;
    protected $_message;
    
    public function setCommentTable(CommentTable $table)
    {
        $this->_commentTable = $table;
    }
    
    public function getCommentTable()
    {
        return $this->_commentTable;
    }
    
    public function setCommentForm(CommentForm $form)
    {
        $this->_commentForm = $form;
    }
    
    public function getCommentForm()
    {
        return $this->_commentForm;
    }
    
    public function setMessage($message)
    {
        $this->_message = $message;
    }
    
    public function getMessage()
    {
        return $this->_message;
    }
    
    public function setAcl($acl)
    {
        $this->_acl = $acl;
    }
    
    public function getAcl()
    {
        return $this->_acl;
    }    
      
    public function getCommentsByTicketId($id)
    {
         
        $comments = $this->getCommentTable()->getCommentsByTicketId($id);
        $commentsTemplate = '';
        $buttons = '';
        //generate template for ajax 
        foreach($comments AS $key => $comment){
           if($this->getAcl()->isAllowed('comments', 'edit')){
                $buttons = '<div class="comments_botton">
                            <button class="submitbutton" id="edit_btn_'.$comment['id'].'"  onclick="edit_comment('.$comment['id'].');">edit</button>
                            <button class="submitbutton" id="delete_btn_'.$comment['id'].'"onclick="delete_comment('.$comment['id'].');">delete</button>
                            <button class="submitbutton" id="save_btn_'.$comment['id'].'" onclick="save_comment('.$comment['id'].');" style="display: none;">save</button>    
                           </div>';
           }
            
            $commentsTemplate .= '<div class="comment_creator">written by :'.$comment['firstname'].' '.$comment['lastname'].'</div>
                                  <div class="comment" id="comment_'.$comment['id'].'">'.$comment['comment'].'</div>
                                  <div class="comment_date">'.$comment['date'].' '.$buttons.'</div>';
                                     
        }
        return $commentsTemplate;
    }
    
    public function saveComment($data)
    {
        if($this->getCommentTable()->insert($data)) {
            $this->setMessage('New Comment created');
            return true;
        }
        $this->setMessage("comment not created");
        return false;
    }
    
    public function updateCommentById($data)
    {
        if($this->getCommentTable()->update($data)) {
            $this->setMessage('Comment updated');
            return true;
        }
        $this->setMessage("comment not updated");
        return false;
    }
    
    public function deleteCommentById($id)
    {
        if($this->getCommentTable()->delete($id)) {
            $this->setMessage('Comment delete');
            return true;
        }
        $this->setMessage("comment not delete");
        return false;
    }
    
}