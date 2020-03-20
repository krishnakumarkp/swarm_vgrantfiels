<?php declare(strict_types=1);
namespace Application\Lib\MysqlStore;
class Database 
{
    //Singleton object
    private static $me;

    public $db;
    public $host;
    public $name;
    public $username;
    public $password;
    public $query;
    public $result;

    private $config;

    private function __construct(\Application\Config\Config $config)
    {
        $this->config = $config;
        $this->host = $this->config->get('dbHost');
        $this->name = $this->config->get('dbName');
        $this->username = $this->config->get('dbUsername');
        $this->password = $this->config->get('dbPassword');

        $this->connect();
        
    }

     // Get Singleton object
    public static function getDatabase(\Application\Config\Config $config): Database
    {
        if(is_null(self::$me)) {
            self::$me = new Database($config);
        }
        return self::$me;
    }

    public function connect(): bool
    {
        $this->db = mysqli_connect($this->host, $this->username, $this->password, $this->name);
        if(mysqli_connect_errno($this->db)){
            trigger_error("Error connecting to databse - Error: ".mysqli_connect_error(), E_USER_ERROR);
        }
        return true;
    }

    public function isConnected()
    {
        return mysqli_ping( $this->db);
    }

    public function select(string $sql, $argsToPrepare=array()): array {
        
        if(is_array($argsToPrepare) && count($argsToPrepare) > 0)  {
            $stmt = $this->preparedQuery($sql, $argsToPrepare);
            if (!$result = mysqli_stmt_get_result($stmt)) {
                trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($this->db), E_USER_ERROR);
            }
            mysqli_stmt_close($stmt);
        }
        else {
            if (!$result = mysqli_query($this->db, $sql)) {
                trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($this->db), E_USER_ERROR);
            }
        }
        $data =  mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $data;
    }

    public function insert(string $sql, $argsToPrepare=array()): ?int {
        $insertId = null;
        if(is_array($argsToPrepare) && count($argsToPrepare) > 0)  {
            $stmt = $this->preparedQuery($sql, $argsToPrepare);
            $insertId = mysqli_insert_id($this->db);
            mysqli_stmt_close($stmt);
        }
        return $insertId;
    }

    private function query(string $sql, $argsToPrepare=array()): ?int {
        $affected_rows = null;
        if(is_array($argsToPrepare) && count($argsToPrepare) > 0)  {
            $stmt = $this->preparedQuery($sql, $argsToPrepare);
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
        }
        return $affected_rows;
    }

    public function update(string $sql, $argsToPrepare=array()): ?int {
        return $this->query($sql, $argsToPrepare);
    }

    public function delete(string $sql, $argsToPrepare=array()): ?int {
        return $this->query($sql, $argsToPrepare);
    }

    public function &preparedQuery(string $sql, $argsToPrepare=array()) {
        
        $paramType = "";
        $params = array();
        $stmt = null;

        if(is_array($argsToPrepare) && count($argsToPrepare) > 0)  {
            if (!$stmt = mysqli_prepare($this->db,  $sql)) {
                trigger_error('prepare() failed Error: '. mysqli_stmt_error($stmt), E_USER_ERROR);
            }
            $params[] = &$stmt;
            $count = count($argsToPrepare);
            for($i= 0; $i < $count; $i++) {
                $paramType .= $this->findType($argsToPrepare[$i]);
            }
            $params[] = &$paramType;

            for($i= 0; $i < $count; $i++) {
                $params[] = &$argsToPrepare[$i];
            }
            $success = call_user_func_array('mysqli_stmt_bind_param', $params);
            if ( false=== $success) {
                trigger_error('bind_param() failed  Error: '. htmlspecialchars(mysqli_stmt_error($stmt)), E_USER_ERROR);
            }
            $success = mysqli_stmt_execute($stmt);
            if ( false=== $success ) {
                trigger_error('execute() failed  Error: '. htmlspecialchars(mysqli_stmt_error($stmt)), E_USER_ERROR);
            }
        }
        return $stmt;
    }

    private function findType($value)
    {
        switch (gettype($value)) {
            case 'NULL':
            case 'string':
                return 's';
                break;
            case 'boolean':
            case 'integer':
                return 'i';
                break;
            case 'blob':
                return 'b';
                break;
            case 'double':
                return 'd';
                break;
        }
        return '';
    }


}