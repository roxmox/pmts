<?php
namespace User\Authentication;

use Zend\Authentication\Result;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Crypt\Password\Bcrypt;
use User\Model\Dbtables\UserTable;

class DbBcryptAdapter implements AdapterInterface
{
    protected $_table = null;
    protected $_bcrypt = null;
    //emailAdresse
    protected $_identity = null;
    //password        
    protected $_credential = null;
    protected $_authenticateResultInfo = null;
    protected $_userId = null;
    
    public function __construct(UserTable $table, Bcrypt $bcrypt) 
    {
        $this->setTable($table);
        $this->setBcrypt($bcrypt);
    }
    
    protected function setupResult()
    {
        $this->_authenticateResultInfo = array(
          'code' => Result::FAILURE,
          'identity' => $this->getIdentity(),
          'messages' => array(),
        );
        return true;
    }
    
    protected function createResult()
    {
        return new Result(
                $this->_authenticateResultInfo['code'],
                $this->_authenticateResultInfo['identity'],
                $this->_authenticateResultInfo['messages']
               );
    }
    
    public function authenticate() 
    {
        $this->setupResult();
        
        //prüfen ob email gesetzt wurde
        if(!$this->getIdentity()) {
            $this->_authenticateResultInfo['messages'][] = 'Sie haben keine Emailadresse eingegeben';
            return $this->createResult();
        }
        
        //prüfen ob passwort gesetzt wurde
        if(!$this->getCredential()) {
            $this->_authenticateResultInfo['messages'][] = 'Sie haben kein Password eingegeben';
            return $this->createResult();
        }
        
        //user mit email aus DB holen
        $user = $this->getTable()->getUserByEmail($this->getIdentity());
        
        if(!$user) {
            $this->_authenticateResultInfo['code'] = Result::FAILURE_IDENTITY_NOT_FOUND;
            $this->_authenticateResultInfo['messages'][] = 'Emailadresse nicht gefunden';
            return $this->createResult();
        }
        
        //user passwort mit bycryppt objekt vergleichen
        $bcrypt = $this->getBcrypt();
        
        $verify = $bcrypt->verify($this->getCredential(), $user->getPass());
        
        if(!$verify) {
            $this->_authenticateResultInfo['code'] = Result::FAILURE_CREDENTIAL_INVALID;
            $this->_authenticateResultInfo['messages'][] = 'Das Passwort ist falsch';
            return $this->createResult();
        }
        
        $user->setPass('');
                    
        //wenn alles passt result objekt zurückgeben
        $this->_authenticateResultInfo['code'] = Result::SUCCESS;
        $this->_authenticateResultInfo['identity'] = $user;
        $this->_authenticateResultInfo['messages'][] = 'Sie wurden eingelogt';
        return $this->createResult();
    }
    
    
    /*
     * Table getter and setter
     */
    public function setTable($table)
    {
        $this->_table = $table;
    }
        
    public function getTable()
    {
        return $this->_table;
    }
    
    /*
     * Bcrypt getter and setter
     */
    public function setBcrypt($bcrypt)
    {
        $this->_bcrypt = $bcrypt;
    }
    
    public function getBcrypt()
    {
        return $this->_bcrypt;
    }
    
    /*
     * identity getter and setter
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
    }
    
    public function getIdentity()
    {
        return $this->_identity;
    }
    
    /*
     * credential getter and setter
     */
    public function setCredential($credential)
    {
        $this->_credential = $credential;
    }
    
    public function getCredential()
    {
        return $this->_credential;
    }
    
    /*
     * id getter and setter
     */
     public function setUserId($id)
     {
         $this->_userId = $id;
         return $this;
     }
     
     public function getUserId()
     {
         return $this->_userId;
     }
          
}
