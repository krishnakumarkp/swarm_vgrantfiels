<?php
namespace Application\Lib;
class User
{
    public $id;
    public $username;
    public $password;

    public function __construct()
    {
        $this->username = "";
        $this->password = "";
        
    }
}