<?php
namespace Application\Core;

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

class Controller
{
    public $db;
    public $session;
    public  $template;
    
    public function __construct(\Application\Lib\MysqlStore\Database $db, \Application\Lib\Session $session)
    {
        $this->db = $db;
        $this->session = $session;
        $this->template = new  \Application\Core\Template();
    }

    public function redirect($location)
    {
        
        header('location: ' . \URL . $location);

    }

    public function getUrl($location)
    {
        if($location){
            return  \URL . $location;
        }
    }

    public function checkIsLoggedIn()
    {
        $auth = new \Application\Models\Auth($this->db, $this->session);
        if(!$auth->isLoggedIn()) {
            header("location: ".  $this->getUrl("auth"));
            die();
        }
        return true;
    }
    
}
?>