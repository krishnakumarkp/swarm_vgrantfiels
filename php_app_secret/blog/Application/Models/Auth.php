<?php
namespace Application\Models;

class Auth extends \Application\Core\Model
{
    private $isLoggedIn;
    public $loginUrl = 'login.php';

    public function __construct($db, $session)
    {
        $this->isLoggedIn = false;
        $this->db = $db;
        $this->session = $session;
    }
    public function login(string $username, string $password)
    {
        $userStore = new \Application\Lib\MysqlStore\UserStore($this->db);     
        $user = $userStore->getByUserName($username); 
        if(is_null($user)) {
            return false;
        }
        if($user->password == $password) {
            $this->isLoggedIn = true;
            $this->session->set('username', $username);
            return true;
        }
        return false;
    }

    public function isLoggedIn()
    {
        if($this->session->get('username')) {
            return true;
        }
        return false;
    }

    public function logout()
    {
        return $this->session->destroy();

    }
}
