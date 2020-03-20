<?php
namespace Application\Controllers;
class AuthController extends \Application\Core\Controller
{
    function index()
    {
        $errorMessage = $this->session->getErrorMessage();

        $data['loginurl'] = $this->getUrl("auth/login");
        $data['errorMessage'] = $errorMessage;
        $this->template->setData($data);
        //$template->setLayout('default');
        $this->template->render("index");
    }

    function register()
    {  
        $data['registerSave'] = $this->getUrl("auth/registerSave");
        $data['indexurl'] = $this->getUrl("index");
        $data['errorMessage'] = $this->session->getErrorMessage();
        $data['successMessage'] = $this->session->getSuccessMessage();

        $this->template->setData($data);
        //$template->setLayout('default');
        $this->template->render("register");
    }

    function registerSave()
    {
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        $userStore = new \Application\Lib\MysqlStore\UserStore($this->db); 
    
        $user = $userStore->getByUserName($userName); 
    
        if($user) {
            $this->session->setErrorMessage("This username is taken");
        }
        else {
            $user = new \Application\Lib\User();
            $user->username = $userName;
            $user->password = $password;
            $user = $userStore->create($user);
            if ($user->id) {
                $this->session->setSuccessMessage("User created");
            }
        }
        header("location: ".  $this->getUrl("auth/register"));
        die();
    }

    function login()
    {
        $auth = new \Application\Models\Auth($this->db, $this->session);
       
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        if($userName && $password) {

            if($auth->login($userName, $password)) {
                //header("location: /admin");
                header("location: ".  $this->getUrl("admin"));
                die();
            }
            else {
                $this->session->setErrorMessage("Invalid username or password!");
                header("location: ".  $this->getUrl("auth"));
                die();
            }

        }
    }

    function logout()
    {
        $auth = new \Application\Models\Auth($this->db, $this->session);
        if($auth->logout()) {
            header("location: ".  $this->getUrl("index"));
            die();
        }
    }
}