<?php
namespace Application\Lib;
class Session
{

    private $sessionName;
    
    public function __construct($sessionName=null, $regenerateId=false, $sessionId=null)
    {
        if (!is_null($sessionId)) {
            session_id($sessionId);
        }
       
        session_start();
        
        if ($regenerateId) {
            //session_regenerate_id(true);
        }

        if (!is_null($sessionName)) {
            $this->sessionName = session_name($sessionName);
        }
    }
    
    
    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
    
    
    public function get($key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
    }    
    
    public function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
   
    
    public function regenerateId($destroyOldSession=false)
    {
        session_regenerate_id(false);
        
        if ($destroyOldSession) {
            //  hang on to the new session id and name
            $sid = session_id();
            //  close the old and new sessions
            session_write_close();
            //  re-open the new session
            session_id($sid);
            session_start();
        }
    }
    
    
    public function destroy()
    {
        return session_destroy();
    }
    
    
    public function getName()
    {
        return $this->sessionName;
    }

    public function setErrorMessage(string $message)
    {
        if(!isset($message)) {
            throw new Exception("Error message is not passed");
        }
        $this->set('error', $message);
    }

    public function getErrorMessage()
    {
        $this->errorMessage = $this->get('error');
        if($this->errorMessage) {
            $this->delete('error');
            return $this->errorMessage;
        }
        return null;
    }
    public function setSuccessMessage(string $message)
    {
        if(!isset($message)) {
            throw new Exception("Success message is not passed");
        }
        $this->set('success', $message);
    }

    public function getSuccessMessage()
    {
        $this->successMessage = $this->get('success');
        if($this->successMessage) {
            $this->delete('success');
            return $this->successMessage;
        }
        return null;
    }

}