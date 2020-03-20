<?php
namespace Application\Lib\MysqlStore;
class UserStore implements \Application\Lib\UserStore
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
        
    }

    public function Create( \Application\Lib\User $user) : \Application\Lib\User
    {
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $user->id = $this->db->insert($query, array($user->username, $user->password));

        return $user;

    }
    
    public function getByUserName(string $userName) : ?\Application\Lib\User
    {
        $query = "SELECT * from users where username = ?";
        $result = $this->db->select($query, array($userName));

        if(count($result) > 0) {
            $user = new \Application\Lib\User();
            $user->id = $result[0]['id'];
            $user->username = $result[0]['username'];
            $user->password = $result[0]['password'];
            return $user;
        }
        return null;

    }
} 